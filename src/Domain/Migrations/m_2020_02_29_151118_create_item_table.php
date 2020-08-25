<?php

namespace Migrations;

use Illuminate\Database\Schema\Blueprint;
use PhpLab\Eloquent\Migration\Base\BaseCreateTableMigration;

class m_2020_02_29_151118_create_item_table extends BaseCreateTableMigration
{

    protected $tableName = 'reference_item';
    protected $tableComment = '';

    public function tableSchema()
    {
        return function (Blueprint $table) {
            $table->integer('id')->autoIncrement()->comment('Идентификатор');
            $table->integer('book_id')->comment('');
            $table->integer('parent_id')->nullable()->comment('');
            $table->string('code')->comment('');
            $table->string('entity')->comment('');
            $table->smallInteger('status')->comment('Статус');
            $table->integer('sort')->nullable()->comment('Порядок сортировки');
            $table->string('props')->nullable()->comment('');
            $table->dateTime('created_at')->comment('Время создания');
            $table->dateTime('updated_at')->nullable()->comment('Время обновления');
        };
    }

}
