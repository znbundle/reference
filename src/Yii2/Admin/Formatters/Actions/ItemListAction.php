<?php

namespace ZnBundle\Reference\Yii2\Admin\Formatters\Actions;

use ZnLib\Web\Components\Widget\Widgets\Format\Formatters\Actions\BaseAction;

class ItemListAction extends BaseAction
{

    public $urlAction = 'index';
    public $type = '';
    public $title = ['reference', 'item.list'];
    public $icon = 'fa fa-list';

}
