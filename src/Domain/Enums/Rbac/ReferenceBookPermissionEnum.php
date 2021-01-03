<?php

namespace ZnBundle\Reference\Domain\Enums\Rbac;

use ZnCore\Base\Interfaces\GetLabelsInterface;

class ReferenceBookPermissionEnum implements GetLabelsInterface
{

    const ALL = 'oReferenceBookAll';
    const ONE = 'oReferenceBookOne';
    const CREATE = 'oReferenceBookCreate';
    const UPDATE = 'oReferenceBookUpdate';
    const DELETE = 'oReferenceBookDelete';
    const RESTORE = 'oReferenceBookRestore';

    public static function getLabels()
    {
        return [
            self::ALL => 'Справочник. Просмотр списка',
            self::ONE => 'Справочник. Просмотр записи',
            self::CREATE => 'Справочник. Создание',
            self::UPDATE => 'Справочник. Редактирование',
            self::DELETE => 'Справочник. Удаление',
            self::RESTORE => 'Справочник. Восстановление',
        ];
    }

}
