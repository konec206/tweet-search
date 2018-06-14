<?php

namespace TweetSearch\SearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $tweetManager = $this->get("tweet_search.manager.tweet");

        $tweets = $tweetManager->getAll();

        return $this->render("@TweetSearchSearch/Default/index.html.twig", [
            "tweets" => $tweets,
        ]);
    }

    public function searchAction(Request $request)
    {
        $searchString = $request->get("search");

        $tweetManager = $this->get("tweet_search.manager.tweet");

        $tweets = $tweetManager->search($searchString);
        $tweetManager->order($tweets, $searchString);

        $template = $this->renderView("@TweetSearchSearch/Default/search.html.twig", [
            "tweets" => $tweets,
        ]);

        $response = [
            "template" => $template,
            "count" => count($tweets),
        ];

        return new JsonResponse(json_encode($response));
    }
}
