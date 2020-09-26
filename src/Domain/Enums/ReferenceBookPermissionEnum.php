<?php

namespace ZnBundle\Reference\Domain\Enums;

use ZnCore\Base\Interfaces\GetLabelsInterface;

class ReferenceBookPermissionEnum implements GetLabelsInterface
{

    const WRITE = 'oReferenceBookWrite';
    const READ = 'oReferenceBookRead';

    public static function getLabels()
    {
        return [
            self::WRITE => 'Справочник. Модификация',
            self::READ => 'Справочник. Чтение',
        ];
    }

}
