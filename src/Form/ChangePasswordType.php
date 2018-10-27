<?php

namespace App\Form;

use App\DataTransformers\StringToArray;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transform = new StringToArray();
        $builder
            ->add('previous pass', TextType::class)
            ->add('new pass', TextType::class);
    }
}
