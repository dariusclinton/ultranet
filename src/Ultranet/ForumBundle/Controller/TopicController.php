<?php

namespace Ultranet\ForumBundle\Controller;

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
class TopicController extends Controller {

  /**
   * 
   * @param type $id
   * @return type
   */
  public function voirAction($forum_name, $topic_title, Request $request) {

    // EM
    $em = $this->getDoctrine()->getManager();

    // Repositories
    $repForum = $em->getRepository('UltranetForumBundle:Forum');
    $repTopic = $em->getRepository('UltranetForumBundle:Topic');

    $forum = $repForum->findOneByName($forum_name);
    $topic = $repTopic->findOneBy(array('title' => $topic_title, 'forum' => $forum));

    if ($forum === null) {
      throw $this->createNotFoundException('Le forum de nom ' + $forum_name + ' est introuvable.');
    }

    if ($topic === null) {
      throw $this->createNotFoundException('Le sujet de titre ' + $topic_title + ' est introuvable.');
    }

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
            'topic_title' => $topic_title
      ));
    }

    // Affichage du Topic et du formulaire de post
    return $this->render('UltranetForumBundle:Topic:voir.html.twig', array(
          'topic' => $topic,
          'forum' => $forum,
          'form' => $form->createView()
    ));
  }

  /**
   * 
   * @param Request $request
   * @return type
   */
  public function addAction(Request $request) {
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
      ));
    }

    return $this->render('UltranetForumBundle:Topic:add.html.twig', array(
          'form' => $form->createView()
    ));
  }

}
