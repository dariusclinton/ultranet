<?php

namespace Ultranet\UserBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class InstitutionType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->remove('email')
            ->remove('city')
            ->remove('birdayDate')
            ->remove('name')
            ->remove('subnames')
            ->remove('phoneNumber')
            ->remove('quarter')
            ->remove('image')
            ->remove('username')
            ->add('institution', EntityType::class, array(
                'class' => 'UltranetUserBundle:Institution',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('i')
                        ->where('i.isValidate = :isValidate')
                        ->setParameter('isValidate', true);
                },
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false,
                'placeholder' => 'Sélectionnez un établissement',
                'required' => true
            ));
    }

    public function getParent()
    {
        return ProfileFormType::class;
    }

}
