<?php

namespace Ultranet\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoreController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $formationRep = $em->getRepository('UltranetCoreBundle:Formation');
        $formations = $formationRep->findBy(array(), null, 6);
        return $this->render('UltranetCoreBundle:Core:index.html.twig', array('formations' => $formations));
    }
}
