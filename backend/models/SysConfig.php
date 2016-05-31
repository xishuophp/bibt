<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sys_config".
 *
 * @property integer $config_id
 * @property string $config_name
 * @property string $config_value
 */
class SysConfig extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sys_config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['config_name', 'config_value'], 'required'],
            [['config_value'], 'string'],
            [['config_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'config_id' => 'Config ID',
            'config_name' => 'Config Name',
            'config_value' => 'Config Value',
        ];
    }
}
