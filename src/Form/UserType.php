<?php

namespace App\Form;

use App\DataTransformers\StringToArray;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transform = new StringToArray();
        $builder
            ->add('username')
            ->add('roles', ChoiceType::class, array(
                'choices' => array(
                    'Administrateur' => 'ROLE_ADMIN',
                    'Collaborateur' => 'ROLE_COWORKER',
                    'Siege' => 'ROLE_SIEGE',
                    'Gestionnaire' => 'ROLE_MANAGER',
                ),
                'label' => 'Type de compte',
                'by_reference'=> false,
                'mapped' => false,
                'expanded' => true,
                'multiple' => false,
            ))
            ->add('password')
            ->add('sauvegarder', SubmitType::class);
    }
}
