<?php

namespace ZnBundle\Reference\Domain\Enums;

use ZnCore\Base\Domain\Base\BaseEnum;

class ReferenceBookPermissionEnum extends BaseEnum
{

    const WRITE = 'oReferenceBookWrite';
    const READ = 'oReferenceBookRead';

    public static function getLabels() {
        return [
            self::WRITE => 'Справочник. Модификация',
            self::READ => 'Справочник. Чтение',
        ];
    }

}
