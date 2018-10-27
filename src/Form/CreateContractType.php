<?php

namespace App\Form;

use App\DataTransformers\StringToArray;
use App\Entity\Manager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;


class CreateContractType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transform = new StringToArray();
        $builder
            ->add('number')
            ->add('description')
            ->add('start_date', DateType::class)
            ->add('end_date', DateType::class)
            ->add('Manager', EntityType::class, array(
                // looks for choices from this entity
                'class' => Manager::class,
                'choice_label' => 'username',
                'required' => false,
                'placeholder' => 'Choisir le manager affilié',
            ));
    }
}