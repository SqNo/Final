<?php

namespace App\Form;

use App\DataTransformers\StringToArray;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class SiegeProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transform = new StringToArray();
        $builder
            ->add('username')
            ->add('password')
            ->add('name');
    }
}
