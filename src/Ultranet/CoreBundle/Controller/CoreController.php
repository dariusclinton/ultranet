<?php

namespace Ultranet\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('UltranetCoreBundle:Core:index.html.twig');
    }
}
