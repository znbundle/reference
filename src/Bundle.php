<?php

namespace ZnBundle\Reference;

use ZnCore\Base\Libs\App\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function yiiAdmin(): array
    {
        return [
            'modules' => [
                'reference' => __NAMESPACE__ . '\Yii2\Admin\Module',
            ],
        ];
    }

    public function i18next(): array
    {
        return [
            'reference' => 'vendor/znbundle/reference/src/Domain/i18next/__lng__/__ns__.json',
        ];
    }

    public function migration(): array
    {
        return [
            '/vendor/znbundle/reference/src/Domain/Migrations',
        ];
    }

    public function container(): array
    {
        return [
            __DIR__ . '/Domain/config/container.php',
        ];
    }
}
