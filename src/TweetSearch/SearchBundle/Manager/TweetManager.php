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

    /**
     * @return array|Tweet[]
     */
    public function getAll() {
        return $this->repo->findAll();
    }

    /**
     * Tweet {#1452 ▼
        -id: 1
        -coordinates: ""
        -createdAt: "Mon+Apr+04+21%3A04%3A59+%2B0000+2016"
        -hashtags: "frise+AAFTroyes16+datasprintAAF"
        -media: ""
        -urls: ""
        -favoriteCount: "0"
        -twitterReference: null
        -inReplyToScreenName: ""
        -inReplyToStatusId: ""
        -lang: "fr"
        -place: ""
        -possiblySensitive: ""
        -retweetCount: "3"
        -retweetId: null
        -retweetScreenName: "daieuxdailleurs"
        -source: "%3Ca+href%3D%22https%3A%2F%2Fabout.twitter.com%2Fproducts%2Ftweetdeck%22+rel%3D%22nofollow%22%3ETweetDeck%3C%2Fa%3E"
        -text: "RT+%40daieuxdailleurs%3A+un+peu+vex%C3%A9e+par+bug+pdt+atelier+%23frise+%23AAFTroyes16+alors+cartographie+%23datasprintAAF+cc+%40archivesBrest+%40Monoprix+htt%E ▶"
        -tweetUrl: "https%3A%2F%2Ftwitter.com%2FBaO_patrimoine%2Fstatus%2F717095645702651904"
        -userCreatedAt: "Tue+Jul+08+19%3A47%3A35+%2B0000+2014"
        -userScreenName: "BaO_patrimoine"
        -userDefaultProfileImage: "false"
        -userDescription: "Bo%C3%AEte+%C3%A0+outils+%23patrimoine+%23culture+%23archives+sauce+%23num%C3%A9rique.+Photos+%3A+https%3A%2F%2Ft.co%2FNVwJwTqabz+et+https%3A%2F%2Ft.co%2FfALA9b ▶"
        -userFavoriteCount: null
        -userFollowerCount: null
        -userFriendsCount: "655"
        -userListedCount: "128"
        -userLocation: ""
        -userName: "Patrimoine%26Num%C3%A9rique"
        -userStatuesCount: null
        -userTimeZone: "Lisbon"
        -userUrls: "http%3A%2F%2Fwww.patrimoine-et-numerique.fr"
        -userVerified: true
        }
     */

    /**
     * @param $searchString
     * @return mixed
     */
    public function parseSearch($searchString) {
        $searchArray = [];

        $searchExploded = explode(" ", $searchString);

        foreach ($searchExploded as $itemOfSearch) {
            $firstChar = mb_substr($itemOfSearch, 0, 1);
            if($firstChar == "@") {
                $searchArray["userName"][] = "'%".substr($itemOfSearch, 1)."%'";
            } elseif($firstChar == "#") {
                $searchArray["hashtags"][] = "'%".substr($itemOfSearch, 1)."%'";
            } else {
                $searchArray["global"]["userDescription"] = "'%".$itemOfSearch."%'";
                $searchArray["global"]["userScreenName"] = "'%".$itemOfSearch."%'";
                $searchArray["global"]["text"] = "'%".$itemOfSearch."%'";
            }
        }

        return $searchArray;
    }

    /**
     * @param $searchAsArray
     * @return array|Tweet[]
     */
    public function doSearch($searchAsArray) {
        $alias = "tweet";
        $repo = $this->em->getRepository(Tweet::class);
        $qb = $repo->createQueryBuilder($alias);

        foreach ($searchAsArray as $searchKey => $searchValueArray) {
            foreach ($searchValueArray as $key => $value) {
                if ($searchKey == "global")
                    $qb->orWhere($qb->expr()->like($alias.".".$key, $value));
                else
                    $qb->andWhere($qb->expr()->like($alias.".".$searchKey, $value));
            }
        }

        return $qb->getQuery()->getResult();
    }

    /**
     * @param $searchString
     * @return array|Tweet[]
     */
    public function search($searchString) {
        $searchAsArray = $this->parseSearch($searchString);
        $results = $this->doSearch($searchAsArray);

        foreach ($results as $result) {
            $result
                ->setText(urldecode($result->getText()))
                ->setCreatedAt(urldecode($result->getCreatedAt()));
        }

        return $results;
    }

    /**
     * @param $tweets
     */
    public function order(&$tweets, $search) {
        $searchMetaphone = metaphone($search);

        usort($tweets, function ($valueA, $valueB) use ($searchMetaphone) {
            $metaphoneTextA = metaphone($valueA->getText());
            $metaphoneTextB = metaphone($valueB->getText());

            return levenshtein($metaphoneTextB, $searchMetaphone) - levenshtein($metaphoneTextA, $searchMetaphone);
        });
    }
}