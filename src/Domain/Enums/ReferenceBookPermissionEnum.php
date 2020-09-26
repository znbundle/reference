<?php

namespace ZnBundle\Reference\Domain\Enums;

class ReferenceBookPermissionEnum
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
