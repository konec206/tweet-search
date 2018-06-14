<?php
/**
 * Created by PhpStorm.
 * User: thibault
 * Date: 17/05/18
 * Time: 11:40
 */

namespace TweetSearch\SearchBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="TweetSearch\SearchBundle\Repository\TweetRepository")
 */
class Tweet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coordinates;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $hashtags;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $media;

    /**
     * @ORM\Column(type="string", length=3000, nullable=true)
     */
    private $urls;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $favoriteCount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $twitterReference;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $inReplyToScreenName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $inReplyToStatusId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lang;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $place;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $possiblySensitive;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $retweetCount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $retweetId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $retweetScreenName;

    /**
     * @ORM\Column(type="string", length=800, nullable=true)
     */
    private $source;

    /**
     * @ORM\Column(type="string", length=800, nullable=true)
     */
    private $text;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tweetUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userCreatedAt;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userScreenName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userDefaultProfileImage;

    /**
     * @ORM\Column(type="string", length=1500, nullable=true)
     */
    private $userDescription;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userFavoriteCount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userFollowerCount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userFriendsCount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userListedCount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userLocation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userStatuesCount;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $userTimeZone;

    /**
     * @ORM\Column(type="string", length=800, nullable=true)
     */
    private $userUrls;

    /**
     * @ORM\Column(type="boolean")
     */
    private $userVerified;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Tweet
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCoordinates()
    {
        return $this->coordinates;
    }

    /**
     * @param mixed $coordinates
     * @return Tweet
     */
    public function setCoordinates($coordinates)
    {
        $this->coordinates = $coordinates;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     * @return Tweet
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHashtags()
    {
        $hashtagsArray = explode(" ", urldecode($this->hashtags));
        $hashtags = [];
        array_walk($hashtagsArray, function (&$value, $key) use (&$hashtags) {
            $hashtags[] = "#".$value;
        });

        return implode(" ", $hashtags);
    }

    /**
     * @param mixed $hashtags
     * @return Tweet
     */
    public function setHashtags($hashtags)
    {
        $this->hashtags = $hashtags;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMedia()
    {
        return $this->media;
    }

    /**
     * @param mixed $media
     * @return Tweet
     */
    public function setMedia($media)
    {
        $this->media = $media;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * @param mixed $urls
     * @return Tweet
     */
    public function setUrls($urls)
    {
        $this->urls = $urls;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFavoriteCount()
    {
        return $this->favoriteCount;
    }

    /**
     * @param mixed $favoriteCount
     * @return Tweet
     */
    public function setFavoriteCount($favoriteCount)
    {
        $this->favoriteCount = $favoriteCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTwitterReference()
    {
        return $this->twitterReference;
    }

    /**
     * @param mixed $twitterReference
     * @return Tweet
     */
    public function setTwitterReference($twitterReference)
    {
        $this->twitterReference = $twitterReference;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInReplyToScreenName()
    {
        return $this->inReplyToScreenName;
    }

    /**
     * @param mixed $inReplyToScreenName
     * @return Tweet
     */
    public function setInReplyToScreenName($inReplyToScreenName)
    {
        $this->inReplyToScreenName = $inReplyToScreenName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getInReplyToStatusId()
    {
        return $this->inReplyToStatusId;
    }

    /**
     * @param mixed $inReplyToStatusId
     * @return Tweet
     */
    public function setInReplyToStatusId($inReplyToStatusId)
    {
        $this->inReplyToStatusId = $inReplyToStatusId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLang()
    {
        return $this->lang;
    }

    /**
     * @param mixed $lang
     * @return Tweet
     */
    public function setLang($lang)
    {
        $this->lang = $lang;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param mixed $place
     * @return Tweet
     */
    public function setPlace($place)
    {
        $this->place = $place;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPossiblySensitive()
    {
        return $this->possiblySensitive;
    }

    /**
     * @param mixed $possiblySensitive
     * @return Tweet
     */
    public function setPossiblySensitive($possiblySensitive)
    {
        $this->possiblySensitive = $possiblySensitive;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRetweetCount()
    {
        return $this->retweetCount;
    }

    /**
     * @param mixed $retweetCount
     * @return Tweet
     */
    public function setRetweetCount($retweetCount)
    {
        $this->retweetCount = $retweetCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRetweetId()
    {
        return $this->retweetId;
    }

    /**
     * @param mixed $retweetId
     * @return Tweet
     */
    public function setRetweetId($retweetId)
    {
        $this->retweetId = $retweetId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRetweetScreenName()
    {
        return $this->retweetScreenName;
    }

    /**
     * @param mixed $retweetScreenName
     * @return Tweet
     */
    public function setRetweetScreenName($retweetScreenName)
    {
        $this->retweetScreenName = $retweetScreenName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     * @return Tweet
     */
    public function setSource($source)
    {
        $this->source = $source;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     * @return Tweet
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTweetUrl()
    {
        return $this->tweetUrl;
    }

    /**
     * @param mixed $tweetUrl
     * @return Tweet
     */
    public function setTweetUrl($tweetUrl)
    {
        $this->tweetUrl = $tweetUrl;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserCreatedAt()
    {
        return $this->userCreatedAt;
    }

    /**
     * @param mixed $userCreatedAt
     * @return Tweet
     */
    public function setUserCreatedAt($userCreatedAt)
    {
        $this->userCreatedAt = $userCreatedAt;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserScreenName()
    {
        return $this->userScreenName;
    }

    /**
     * @param mixed $userScreenName
     * @return Tweet
     */
    public function setUserScreenName($userScreenName)
    {
        $this->userScreenName = $userScreenName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserDefaultProfileImage()
    {
        return $this->userDefaultProfileImage;
    }

    /**
     * @param mixed $userDefaultProfileImage
     * @return Tweet
     */
    public function setUserDefaultProfileImage($userDefaultProfileImage)
    {
        $this->userDefaultProfileImage = $userDefaultProfileImage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserDescription()
    {
        return $this->userDescription;
    }

    /**
     * @param mixed $userDescription
     * @return Tweet
     */
    public function setUserDescription($userDescription)
    {
        $this->userDescription = $userDescription;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserFavoriteCount()
    {
        return $this->userFavoriteCount;
    }

    /**
     * @param mixed $userFavoriteCount
     * @return Tweet
     */
    public function setUserFavoriteCount($userFavoriteCount)
    {
        $this->userFavoriteCount = $userFavoriteCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserFollowerCount()
    {
        return $this->userFollowerCount;
    }

    /**
     * @param mixed $userFollowerCount
     * @return Tweet
     */
    public function setUserFollowerCount($userFollowerCount)
    {
        $this->userFollowerCount = $userFollowerCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserFriendsCount()
    {
        return $this->userFriendsCount;
    }

    /**
     * @param mixed $userFriendsCount
     * @return Tweet
     */
    public function setUserFriendsCount($userFriendsCount)
    {
        $this->userFriendsCount = $userFriendsCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserListedCount()
    {
        return $this->userListedCount;
    }

    /**
     * @param mixed $userListedCount
     * @return Tweet
     */
    public function setUserListedCount($userListedCount)
    {
        $this->userListedCount = $userListedCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserLocation()
    {
        return $this->userLocation;
    }

    /**
     * @param mixed $userLocation
     * @return Tweet
     */
    public function setUserLocation($userLocation)
    {
        $this->userLocation = $userLocation;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     * @return Tweet
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserStatuesCount()
    {
        return $this->userStatuesCount;
    }

    /**
     * @param mixed $userStatuesCount
     * @return Tweet
     */
    public function setUserStatuesCount($userStatuesCount)
    {
        $this->userStatuesCount = $userStatuesCount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserTimeZone()
    {
        return $this->userTimeZone;
    }

    /**
     * @param mixed $userTimeZone
     * @return Tweet
     */
    public function setUserTimeZone($userTimeZone)
    {
        $this->userTimeZone = $userTimeZone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserUrls()
    {
        return $this->userUrls;
    }

    /**
     * @param mixed $userUrls
     * @return Tweet
     */
    public function setUserUrls($userUrls)
    {
        $this->userUrls = $userUrls;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUserVerified()
    {
        return $this->userVerified;
    }

    /**
     * @param mixed $userVerified
     * @return Tweet
     */
    public function setUserVerified($userVerified)
    {
        $this->userVerified = $userVerified;
        return $this;
    }
}