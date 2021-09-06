<?php

namespace ZnBundle\Reference\Domain\Constraints;

use Symfony\Component\Validator\Constraint;

class ReferenceItem extends Constraint
{

    public $message = 'The item id "{{ string }}" does not belong to the book "{{ bookName }}"';
    public $notFoundMessage = 'Item with id "{{ string }}" not found';
    public $bookName;
}
