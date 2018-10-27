<?php

namespace App\Form;

use App\DataTransformers\StringToArray;
use App\Entity\Siege;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ManagerProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transform = new StringToArray();
        $builder
            ->add('username')
            ->add('password')
            ->add('Siege', EntityType::class, array(
            // looks for choices from this entity
            'class' => Siege::class,
            'choice_label' => 'username',
        ))
            ->add('name');

    }
}