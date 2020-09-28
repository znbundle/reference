<?php

use yii\rest\UrlRule;
//$version = API_VERSION_STRING;

return [
    ["class" => UrlRule::class, "controller" => ["{$version}/reference-book" => "reference/book"]],
    ["class" => UrlRule::class, "controller" => ["{$version}/reference-item" => "reference/item"]],
];
