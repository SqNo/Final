<?php

namespace App\Form;

use App\DataTransformers\StringToArray;
use App\Entity\Contract;

use App\Entity\Guarantee;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;


class CreateSinisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transform = new StringToArray();
        $builder
            ->add('description')
            ->add('entry_date', DateType::class)
            ->add('Guarantee', EntityType::class, array(
                // looks for choices from this entity
                'class' => Guarantee::class,
                'choice_label' => 'name',
                'placeholder' => 'Choisir le Garantie affiliée',
            ));
    }
}