<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ultranet\UserBundle\Controller;

use FOS\UserBundle\Controller\ProfileController as BaseController;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Ultranet\CoreBundle\Entity\Schedule;
use Ultranet\CoreBundle\Form\ScheduleType;
use Ultranet\UserBundle\Entity\Institution;
use Ultranet\UserBundle\Form\InstitutionFormType;
use Ultranet\UserBundle\Form\Type\InstitutionType;

/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends BaseController {

    /**
     * Show the user
     */
    public function showAction() {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        return $this->render('FOSUserBundle:Profile:show.html.twig', array(
                    'user' => $user
        ));
    }

    /**
     * Edit the user
     */
    public function editAction(Request $request) {
        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->get('event_dispatcher');

        $event = new GetResponseUserEvent($user, $request);
        $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        /** @var $formFactory \FOS\UserBundle\Form\Factory\FactoryInterface */
            $formFactory = $this->get('fos_user.profile.form.factory');

        $formUser = $formFactory->createForm();
        $formUser->setData($user);
        
        $institution = $user->getInstitution();
        $formInstitution = $this->createForm(InstitutionType::class, $user);  
        
        $newInst = new Institution();
        $formNewInst = $this->createForm(InstitutionFormType::class, $newInst);

        $schedule = new Schedule();
        $formSchedule = $this->createForm(ScheduleType::class, $schedule);
        
        $formUser->handleRequest($request);
        $formInstitution->handleRequest($request);
        $formNewInst->handleRequest($request);
        
        if($formNewInst->isSubmitted() && $formNewInst->isValid()){
            $em = $this->getDoctrine()->getManager();
            $user->setInstitution($newInst);
            $em->persist($newInst);
            $em->flush();

            return $this->redirectToRoute("fos_user_profile_edit");
        }

        if ($formUser->isSubmitted() && $formUser->isValid() || $formInstitution->isSubmitted() && $formInstitution->isValid()) {
            /** @var $userManager \FOS\UserBundle\Model\UserManagerInterface */
            $userManager = $this->get('fos_user.user_manager');

            $event = new FormEvent($formUser, $request);
            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_SUCCESS, $event);

            $userManager->updateUser($user);

            if (null === $response = $event->getResponse()) {
                $url = $this->generateUrl('fos_user_profile_edit');
                $response = new RedirectResponse($url);
            }

            $dispatcher->dispatch(FOSUserEvents::PROFILE_EDIT_COMPLETED, new FilterUserResponseEvent($user, $request, $response));

            return $response;
        }

        return $this->render('FOSUserBundle:Profile:edit.html.twig', array(
                    'formUser' => $formUser->createView(),
                    'formInstitution' => $formInstitution->createView(),
                    'formNewinst' => $formNewInst->createView(),
                    'formSchedule' => $formSchedule->createView(),
        ));
    }

}
