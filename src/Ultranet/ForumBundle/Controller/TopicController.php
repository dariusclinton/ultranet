<?php

namespace Ultranet\ForumBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ultranet\ForumBundle\Entity\Topic;
use Ultranet\ForumBundle\Form\TopicType;
use Symfony\Component\HttpFoundation\Request;
use Ultranet\ForumBundle\Entity\Post;
use Ultranet\ForumBundle\Form\PostType;

/**
 * Description of TopicController
 *
 * @author tsafack
 */
class TopicController extends Controller
{

  /**
   *
   * @param type $title
   * @return type
   */
  public function allAction($forum_name, $page)
  {
    $nombreParPage = 3;

    $em = $this->getDoctrine()->getManager();

    $forum = $em->getRepository('UltranetForumBundle:Forum')->findOneByName($forum_name);
    $topics = $em->getRepository('UltranetForumBundle:Topic')->getTopics($nombreParPage, $page, $forum);

    if (!$forum) {
      throw $this->createNotFoundException('Le forum de nom ' + $forum_name + ' est introuvable.');
    }

    $nombrePage = ceil(count($topics) / $nombreParPage);

    return $this->render('UltranetForumBundle:Topic:all.html.twig', array(
      'forum' => $forum,
      'topics' => $topics,
      'page' => $page,
      'nombrePage' => $nombrePage,
      'move_up' => $page + 1,
      'move_down' => $page - 1
    ));
  }

  /**
   *
   * @param type $id
   * @return type
   */
  public function voirAction($forum_name, $topic_title, $page, Request $request)
  {
    // Nombre de Post affiches par page
    $nombreParPage = 3;

    // EM
    $em = $this->getDoctrine()->getManager();

    // Repositories
    $repForum = $em->getRepository('UltranetForumBundle:Forum');
    $repTopic = $em->getRepository('UltranetForumBundle:Topic');
    $repPost = $em->getRepository('UltranetForumBundle:Post');

    $forum = $repForum->findOneByName($forum_name);
    $topic = $repTopic->findOneBy(array('title' => $topic_title, 'forum' => $forum));

    if ($forum === null) {
      throw $this->createNotFoundException('Le forum de nom ' + $forum_name + ' est introuvable.');
    }

    if ($topic === null) {
      throw $this->createNotFoundException('Le sujet de titre ' + $topic_title + ' est introuvable.');
    }

    // On recupere les Posts depuis le depot (Pagination)
    $posts = $repPost->getPosts($nombreParPage, $page, $topic);

    $nombrePage = ceil(count($posts) / $nombreParPage);

    // Creation du Formulaire
    $post = new Post();

    $form = $this->createForm(PostType::class, $post);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      // On recupere l'utilisateur courant
      $user = $this->getUser();

      if ($user === null) {
        throw $this->createNotFoundException('Utilisateur inconnu.');
      }

      $post->setCreateur($user);
      $post->setTopic($topic);

      $forum->setLastPost($post);
      $topic->setLastPost($post);

      $em->persist($post);
      $em->flush();

      // Affichage du Topic
      return $this->redirectToRoute('ultranet_forum_topic_voir', array(
        'forum_name' => $forum_name,
        'topic_title' => $topic_title,
        'posts' => $posts,
        'page' => $page,
        'nombrePage' => $nombrePage,
        'move_up' => $page + 1,
        'move_down' => $page - 1
      ));
    }

    // Affichage du Topic et du formulaire de post
    return $this->render('UltranetForumBundle:Topic:voir.html.twig', array(
      'topic' => $topic,
      'forum' => $forum,
      'posts' => $posts,
      'form' => $form->createView(),
      'page' => $page,
      'nombrePage' => $nombrePage,
      'move_up' => $page + 1,
      'move_down' => $page - 1
    ));
  }

  /**
   *
   * @param Request $request
   * @return type
   *
   * @Security("has_role('ROLE_USER')")
   */
  public function addAction(Request $request)
  {
    // On teste si l'utilisateur est authentifie
    $user = $this->getUser();

    if ($user === null) {
      $this->createNotFoundException('Utilisateur non authentifié.');
    }

    // Creation du formulaire
    $topic = new Topic();

    $form = $this->createForm(TopicType::class, $topic);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $topic->setCreateur($user);

      $topic->getFirstPost()->setCreateur($user);
      $topic->getFirstPost()->setTopic($topic);

      $topic->setLastPost($topic->getFirstPost());

      $topic->getForum()->setLastPost($topic->getFirstPost());

      // EM
      $em = $this->getDoctrine()->getManager();

      $em->persist($topic);
      $em->flush();

      // Affichage du Topic
      return $this->redirectToRoute('ultranet_forum_topic_voir', array(
        'forum_name' => $topic->getForum()->getName(),
        'topic_title' => $topic->getTitle(),
        'page' => 1
      ));
    }

    return $this->render('UltranetForumBundle:Topic:add.html.twig', array(
      'form' => $form->createView()
    ));
  }

  /**
   * @param Topic $topic
   * @param $forum_name
   * @param $topic_title
   * @param $page
   */
  public function resoluAction(Topic $topic, $forum_name, $topic_title, $page) {
    // Nombre de Posts affiches par page
    $nombreParPage = 3;

    // On recupere le repository de l'entite Post
    $em = $this->getDoctrine()->getManager();
    $rep = $em->getRepository('UltranetForumBundle:Post');

    // Si le sujet est deja n'est pas resolu on le marque resolu
    // Sinon on le marque non resolu
    if ($topic->getIsResolu()) {
      $topic->setIsResolu(false);
    } else {
      $topic->setIsResolu(true);
    }

    // On valide les modifications
    $em->flush();

    // On recuperes les Posts depuis le depot(pagination)
    $posts = $rep->getPosts($nombreParPage, $page, $topic);

    $nombrePage = ceil(count($nombreParPage)/$nombreParPage);

    // Affichage du Topic
    return $this->redirectToRoute('ultranet_forum_topic_voir', array(
      'forum_name' => $forum_name,
      'topic_title' => $topic_title,
      'posts' => $posts,
      'page' => $page,
      'nombrePage' => $nombrePage,
      'move_up' => $page + 1,
      'move_down' => $page - 1
    ));
  }

  /**
   * @param Topic $topic
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
   *
   * @Security("has_role('ROLE_USER')")
   */
  public function editAction(Topic $topic, Request $request) {
    // Creation du formulaire
    $form = $this->createForm(TopicType::class, $topic);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      // EM
      $em = $this->getDoctrine()->getManager();

      $em->flush();

      // Affichage du Topic
      return $this->redirectToRoute('ultranet_forum_topic_voir', array(
        'forum_name' => $topic->getForum()->getName(),
        'topic_title' => $topic->getTitle(),
        'page' => 1
      ));
    }

    return $this->render('UltranetForumBundle:Topic:edit.html.twig', array(
      'form' => $form->createView()
    ));
  }
}
