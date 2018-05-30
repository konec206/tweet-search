<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 17/05/18
 * Time: 11:36
 */

namespace TweetSearch\SearchBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportTweetCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName("tweet-search:import-tweet")
            ->setDescription("Import the tweets from the file media/tweets_hydrated_csv.csv");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filename = \AppKernel::getMediaDir()."tweets_hydrated_csv.csv";

        if (!is_file($filename))
        {
            $output->writeln("<error>File $filename not found!</error>");
            return 0;
        }

        $count = 729;
        $progress = new ProgressBar($output, $count);

        $output->writeln("<info>Starting the import of $count tweets from the file : $filename</info>");

        $headers = [];
        $line = 0;
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while(($fileContent = fgetcsv($handle)) !== FALSE) {
                if ($line != 0) {
                    $progress->advance();

                    $tweet = $this->getContainer()->get("tweet_search.manager.tweet")->create();

                    foreach ($headers as $key => $str) {
                        $functionName = "set".$this->formatToFunctionName($str);
                        if (method_exists($tweet, $functionName)) {
                            $tweet->$functionName(urlencode($fileContent[$key]));
                        }
                    }

                    $this->getContainer()->get("tweet_search.manager.tweet")->save($tweet);
                } else {
                    $headers = $fileContent;
                }
                $line++;
            }
        }

        $progress->finish();

        $output->writeln("");
        $output->writeln("<info>Finished imported $count tweets.</info>");

        return 0;
    }

    private function formatToFunctionName($str) {
        if ($str == "id")
            return "TweeterReference";
        else {
            $strExploded = explode("_", $str);
            array_walk($strExploded, ['self', 'uc_first_callback']);
            $str = implode($strExploded);
        }

        return $str;
    }

    static function uc_first_callback(&$str) {
        $str = ucfirst($str);
    }
}