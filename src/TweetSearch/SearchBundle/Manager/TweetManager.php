<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 17/05/18
 * Time: 15:26
 */

namespace TweetSearch\SearchBundle\Manager;


use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;
use TweetSearch\SearchBundle\Entity\Tweet;

class TweetManager
{
    private $em;
    private $repo;

    /**
     * TweetManager constructor.
     * @param $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;

        $this->repo = $this->em->getRepository(Tweet::class);
    }

    /**
     * @return Tweet
     */
    public function create() {
        $tweet = new Tweet();

        return $tweet;
    }

    /**
     * @param $tweet
     * @param bool $flush
     */
    public function save($tweet, $flush = true) {
        $this->em->persist($tweet);
        if ($flush)
            $this->em->flush();
    }

    public function getAll() {
        return $this->repo->findAll();
    }
}