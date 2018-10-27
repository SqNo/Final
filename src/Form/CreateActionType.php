<?php

namespace App\Form;

use App\DataTransformers\StringToArray;
use App\Entity\Contract;

use App\Entity\Guarantee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;


class CreateActionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transform = new StringToArray();
        $builder
            ->add('name')
            ->add('startDate', DateType::class)
            ->add('endDate', DateType::class)
            ->add('Contract', EntityType::class, array(
                // looks for choices from this entity
                'class' => Contract::class,
                'choice_label' => 'number',
                'placeholder' => 'Choisir le contrat affilié',
            ));
    }
}