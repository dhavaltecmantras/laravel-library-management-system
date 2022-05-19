<?php

namespace App\Domain\Actions;

interface ActionInterface
{
    /**
     * Every Action should have a do() method. The data required for the do() should be injected as an array.
     * The method should return relevant information about the outcome (eg insert id, Model instance) in another array,
     * or throw an Exception.
     *
     * @param array $data
     * @return array
     */
    public function do(array $data): array;
}
