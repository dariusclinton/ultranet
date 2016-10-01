<?php

namespace Ultranet\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

    $forums = $repForum->findAll();
    $categories = $repCategorie->findAll();

    return $this->render('UltranetForumBundle:Forum:index.html.twig', array(
      'forums' => $forums,
      'categories' => $categories
    ));
  }

  /**
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function searchAction(Request $request)
  {
    $searchPattern = '';
    $resultats     = array();

    $rep = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('UltranetForumBundle:Topic');

    if ($request->get("search_pattern")) {
      $searchPattern = $request->get("search_pattern");
      $resultats = $rep->findLike($searchPattern);
    }

    return $this->render('UltranetForumBundle:Forum:results.html.twig', array(
      'resultats'     => $resultats,
      'searchPattern' => $searchPattern
    ));
  }
}
