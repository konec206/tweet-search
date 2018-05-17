<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 17/05/18
 * Time: 11:36
 */

namespace TweetSearch\SearchBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportTweetCommand extends Command
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

        $count = 0;
        $fp = file($filename, FILE_SKIP_EMPTY_LINES);
        $count = count($fp);

        $progress = new ProgressBar($output, $count);

        $output->writeln("<info>Starting the import of $count tweets from the file : $filename</info>");

        /**
         * 0 created_at
         * 1 hashtags
         * 2 media
         * 3 urls
         * 4 favorite_count
         * 5 id (tweeterReference)
         * 6 in_reply_to_screen_name
         * 7 in_reply_to_status_id
         * 8 in_reply_to_user_id
         * 9 lang
         * 10 place
         * 11 possibly_sensitive
         * 12 retweet_count
         * 13 reweet_id
         * 14 retweet_screen_name
         * 15 source
         * 16 text
         * 17 tweet_url
         * 18 user_created_at
         * 19 user_screen_name
         * 20 user_default_profile_image
         * 21 user_description
         * 22 user_favourites_count
         * 23 user_followers_count
         * 24 user_friends_count
         * 25 user_listed_count
         * 26 user_location
         * 27 user_name
         * 28 user_screen_name
         * 29 user_statuses_count
         * 30 user_time_zone
         * 31 user_urls
         * 32 user_verified
         */

        $headers = [];
        $line = 0;
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while(($fileContent = fgetcsv($handle)) !== FALSE) {
                if ($line != 0) {
                    $progress->advance();

                    
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

    static function uc_first_callback(&$str, $key) {
        $str = ucfirst($str);
    }
}