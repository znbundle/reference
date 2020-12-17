<?php

namespace ZnBundle\Reference\Domain\Enums;

use ZnCore\Base\Interfaces\GetLabelsInterface;

class ReferenceItemPermissionEnum implements GetLabelsInterface
{

    const WRITE = 'oReferenceItemWrite';
    const READ = 'oReferenceItemRead';

    public static function getLabels()
    {
        return [
            self::WRITE => 'Значения справочника. Модификация',
            self::READ => 'Значения справочника. Чтение',
        ];
    }

}
