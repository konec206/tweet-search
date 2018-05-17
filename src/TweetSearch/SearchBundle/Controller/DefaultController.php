<?php

namespace TweetSearch\SearchBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render("@TweetSearchSearch/Default/index.html.twig");
    }
}
