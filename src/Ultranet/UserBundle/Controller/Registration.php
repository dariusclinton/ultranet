<?php

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegistrationController extends Controller {

    public function registerAction(Request $request) {
        return $this->container
                        ->get('fos_user.user_manager')
                        ->register('Ultranet\UserBundle\Entity\User');
    }

}
