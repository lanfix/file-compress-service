<?php

use yii\db\Migration;

class m201019_195000_add_image_formats extends Migration
{

    /**
     * @inheritDoc
     */
    public function safeUp()
    {
        $this->createTable('image_formats', [
            'code' => 'VARCHAR(16) NOT NULL PRIMARY KEY',
            'width' => $this->integer(),
            'height' => $this->integer(),
        ]);
        $this->batchInsert('image_formats', ['code', 'width', 'height'], [
            ['big', 800, 600],
            ['med', 640, 480],
            ['min', 320, 240],
            ['mic', 150, 150],
        ]);
    }

    /**
     * @inheritDoc
     */
    public function safeDown()
    {
        $this->dropTable('image_formats');
    }

}