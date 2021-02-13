<?php

namespace ZnBundle\Reference\Yii2\Admin\Forms;

use ZnYii\Base\Forms\BaseForm;

class BookForm extends BaseForm
{

    public $title = null;
    public $levels = 1;
    public $entity = null;
    public $status = 1;

    public function i18NextConfig(): array
    {
        return [
            'bundle' => 'reference',
            'file' => 'book',
        ];
    }

    public function translateAliases(): array
    {
        return [
            'status_id' => 'status',
        ];
    }
}