<?php

namespace Ultranet\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class ProfileFormType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('name', TextType::class)
                ->add('subnames', TextType::class)
                ->add('phoneNumber', TextType::class)
                ->add('city', TextType::class)
                ->add('quarter', TextType::class)
                ->add('birdayDate', BirthdayType::class, array(
                    'years' => range(1950, 2006),
                    'placeholder' => '--',
                ))
                ;
    }

    // BC for SF < 3.0
    public function getName() {
        return $this->getBlockPrefix();
    }

    public function getParent() {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }

    public function getBlockPrefix() {
        return 'ultranet_user_profile';
    }

}
