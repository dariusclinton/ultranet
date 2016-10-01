<?php

namespace Ultranet\ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ultranet\ForumBundle\Entity\Forum;
use Ultranet\ForumBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Request;
use Ultranet\ForumBundle\Form\PostType;

class PostController extends Controller
{
  /**
   * @param Post $post
   * @param $page
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
   */
  public function editAction(Post $post, $page, Request $request)
  {
    $nombreParPage = 3;

    // EM
    $em = $this->getDoctrine()->getManager();

    $rep = $em->getRepository('UltranetForumBundle:Post');

    $topic = $post->getTopic();
    $forum = $topic->getForum();
    $posts = $rep->getPosts($nombreParPage, $page, $topic);

    $nombrePage = ceil(count($posts) / 3);

    // Creation du Formulaire

    $form = $this->createForm(PostType::class, $post);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $em->flush();

      // Affichage du Topic
      return $this->redirectToRoute('ultranet_forum_topic_voir', array(
        'forum_name' => $forum->getName(),
        'topic_title' => $topic->getTitle(),
        'posts' => $posts,
        'page' => $page,
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
   * @param Post $post
   * @param $page
   * @param Request $request
   * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
   */
  public function repondreAction(Post $post, $page, Request $request)
  {
    $nombreParPage = 3;

    // EM
    $em = $this->getDoctrine()->getManager();

    $rep = $em->getRepository('UltranetForumBundle:Post');

    $topic = $post->getTopic();
    $forum = $topic->getForum();
    $posts = $rep->getPosts($nombreParPage, $page, $topic);

    $nombrePage = ceil(count($posts) / 3);

    // Recuperation du contenu du post a repondre
    $contenu = $post->getTexte();
    // On ajoute une barre pour separer les 2 contenus
    $contenu = $contenu . "\n\n";

    // Creation du Formulaire
    $postReponse = new Post();
    $postReponse->setTexte($contenu);

    $form = $this->createForm(PostType::class, $postReponse);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $postReponse->setTexte(nl2br($postReponse->getTexte()));

      // On recupere l'utilisateur courant
      $user = $this->getUser();

      if ($user === null) {
        throw $this->createNotFoundException('Utilisateur inconnu.');
      }

      $postReponse->setCreateur($user);
      $postReponse->setTopic($topic);

      $forum->setLastPost($postReponse);
      $topic->setLastPost($postReponse);

      $em->persist($post);
      $em->flush();

      // Affichage du Topic
      return $this->redirectToRoute('ultranet_forum_topic_voir', array(
        'forum_name' => $forum->getName(),
        'topic_title' => $topic->getTitle(),
        'posts' => $posts,
        'page' => $page,
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
}
