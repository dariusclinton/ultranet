<?php

namespace Ultranet\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FormationController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $formationRep = $em->getRepository("UltranetCoreBundle:Formation");
        $formations = $formationRep->findAll();
        return $this->render('UltranetCoreBundle:Formation:index.html.twig', array('formations' => $formations));
    }

     public function showAction(Formation $formation){
         return $this->render('UltranetCoreBundle:Formation:index.html.twig', array('formation' => $formation));
     }
}
