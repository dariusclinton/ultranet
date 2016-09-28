<?php

namespace Ultranet\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function indexAction()
    {
        return $this->render("UltranetCoreBundle:Contact:index.html.twig");
    }
}
