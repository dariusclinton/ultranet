<?php

namespace Ultranet\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ultranet\ForumBundle\Entity\Forum;

class ForumController extends Controller
{
  /**
   * 
   * @return type
   */
    public function indexAction()
    {
      $em = $this->getDoctrine()->getManager();
      
      $repForum = $em->getRepository('UltranetForumBundle:Forum');
      $repCategorie = $em->getRepository('UltranetForumBundle:Category');
      
      $forums     = $repForum->findAll();
      $categories = $repCategorie->findAll();
      
      return $this->render('UltranetForumBundle:Forum:index.html.twig', array(
        'forums'     => $forums,
        'categories' => $categories
      ));
    }
    
    /**
     * 
     * @param type $title
     * @return type
     */
    public function topicsAction($name) {
      $forum = $this
          ->getDoctrine()
          ->getRepository('UltranetForumBundle:Forum')->findOneByName($name);
      
      if (!$forum) {
        throw $this->createNotFoundException('Le forum de nom '+$name+' est introuvable.' );
      }
      
      return $this->render('UltranetForumBundle:Forum:topics.html.twig', array(
        'forum' => $forum
      ));
    }
}
