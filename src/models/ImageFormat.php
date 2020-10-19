<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * @property string $code
 * @property int $width
 * @property int $height
 */
class ImageFormat extends ActiveRecord
{

    /**
     * @inheritDoc
     */
    public static function tableName()
    {
        return 'image_formats';
    }

}