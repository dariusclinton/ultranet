<?php

namespace Ultranet\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    public function indexAction()
    {
        return $this->render("UltranetCoreBundle:Contact:index.html.twig");
    }

    public function formAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            //recuperation des params de la requete
            $name = $request->query->get('name');
            $email = $request->query->get('email');
            $message = $request->query->get('message');

            $swiftMessage = \Swift_Message::newInstance()
                ->setContentType('text/html')
                ->setSubject('ConctactUser')
                ->setFrom($email)
                ->setTo('loickaptue@yahoo.fr')
                ->setBody('Message venant de '.$name.' \n'.$message);

            $mailer = $this->get('mailer');
            $status = $mailer->send($swiftMessage);
            if ($status == 0)
                return new JsonResponse("error");
            else
                return new JsonResponse("success");
        }
    }
}
