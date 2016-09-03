<?php

namespace Utranet\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UtranetCoreBundle:Default:index.html.twig');
    }
}
