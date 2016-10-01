<?php

namespace Ultranet\CoreBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ScheduleType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', ChoiceType::class, array(
                'choices' => array(
                    'Lundi' => 'Lundi',
                    'Mardi' => 'Mardi',
                    'Mercredi' => 'Mercredi',
                    'Jeudi' => 'Jeudi',
                    'Vendredi' => 'Vendredi',
                    'Samedi' => 'Samedi',
                    'Dimanche' => 'Dimanche',
                ),
                'placeholder' => 'jour',
                'multiple' => false,
                'required' => true,
            ))
            ->add('tranche', ChoiceType::class, array(
                'choices' => array(
                    '08h00 - 09h00' => '08h00 - 09h00',
                    '09h00 - 10h00' => '09h00 - 10h00',
                    '10h00 - 11h00' => '10h00 - 11h00',
                    '11h00 - 12h00' => '11h00 - 12h00',
                    '12h00 - 13h00' => '12h00 - 13h00',
                    '14h00 - 15h00' => '14h00 - 15h00',
                    '15h00 - 16h00' => '15h00 - 16h00',
                ),
                'multiple' => false,
                'required' => true,
                'placeholder' => 'tranche horaire'
            ))
            ->add('formation', EntityType::class, array(
                'class' => 'Ultranet\CoreBundle\Entity\Formation',
                'choice_label' => 'name',
                'required' => true,
                'placeholder'=> 'formation',
                'multiple' => false,
            ))
            ->add('level', ChoiceType::class, array(
                'choices' => array(
                    'A' => 'A',
                    'B' => 'B',
                    'C' => 'C',
                    'debutant' => 'debutant',
                    'moyen' => 'moyen',
                    'haut niveau' => 'haut niveau',
                ),
                'placeholder' => 'niveau',
                'multiple' => false,
                'required' => false
            ))
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ultranet\CoreBundle\Entity\Schedule'
        ));
    }
}
