<?php

namespace Ultranet\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ForumController extends Controller
{
    public function indexAction()
    {
        return $this->render('UltranetForumBundle:Forum:index.html.twig');
    }
}
