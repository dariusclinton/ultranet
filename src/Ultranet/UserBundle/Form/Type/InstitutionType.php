<?php

namespace Ultranet\UserBundle\Form\Type;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
    
class InstitutionType extends AbstractType {

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->remove('email')
                ->remove('city')
                ->remove('birdayDate')
                ->remove('name')
                ->remove('subnames')
                ->remove('phoneNumber')
                ->remove('quarter')
                ->add('institution', EntityType::class, array(
                    'class' => 'UltranetUserBundle:Institution',
                    'choice_label' => 'name',
                    'multiple' => false,
                    'expanded' => false,
                ))
        ;
    }
    
    public function getParent() {
        return ProfileFormType::class;
    }

}
