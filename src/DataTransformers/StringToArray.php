<?php

namespace App\DataTransformers;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class StringToArray implements DataTransformerInterface
{
    /**
     * Transforms an array to a string. 
     * POSSIBLE LOSS OF DATA
     *
     * @return string
     */
    public function transform($array)
    {
        return $array[0];
    }

    /**
     * Transforms a string to an array.
     *
     * @param  string $string
     *
     * @return array
     */
    public function reverseTransform($string)
    {
        return array($string);
    }
}