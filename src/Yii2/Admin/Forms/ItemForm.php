<?php

namespace ZnBundle\Reference\Yii2\Admin\Forms;

use ZnCore\Base\Status\Enums\StatusEnum;
use ZnYii\Base\Forms\BaseForm;

class ItemForm extends BaseForm
{

    public $title = null;
    public $levels = 1;
    public $book_id = null;
    public $entity = null;
    public $status = StatusEnum::ENABLED;
    public $sort = 1;

    public function i18NextConfig(): array
    {
        return [
            'bundle' => 'reference',
            'file' => 'item',
        ];
    }

    public function translateAliases(): array
    {
        return [
            'status_id' => 'status',
            'book_id' => 'book',
        ];
    }
}