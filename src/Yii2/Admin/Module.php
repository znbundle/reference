<?php

namespace ZnBundle\Reference\Yii2\Admin;

use yii\base\Module as YiiModule;
use yii\helpers\Url;
use ZnCore\Base\I18Next\Facades\I18Next;
use ZnLib\Web\Widgets\BreadcrumbWidget;

class Module extends YiiModule
{

    public function __construct($id, $parent = null, $config = [], BreadcrumbWidget $breadcrumbWidget)
    {
        parent::__construct($id, $parent, $config);
        $breadcrumbWidget->add(I18Next::t('reference', 'index.title'), Url::to(['/reference']));
    }

    public $defaultRoute = 'book';
    public $controllerNamespace = __NAMESPACE__ . '\Controllers';

}
