<?php

namespace ZnBundle\Reference\Yii2\Admin\Filters;

use Packages\Utility\Domain\Filters\BaseStatusFilter;
use Symfony\Component\Validator\Mapping\ClassMetadata;

class BookFilter extends BaseStatusFilter
{

    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        self::loadStatusValidatorMetadata($metadata);
    }
}
