<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "nav".
 *
 * @property integer $nav_id
 * @property string $nav_name
 * @property integer $nav_type
 * @property string $nav_link
 * @property string $nav_logo
 * @property integer $parent_id
 * @property integer $order_no
 */
class Nav extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'nav';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nav_name'], 'required'],
            [['nav_type', 'parent_id', 'order_no'], 'integer'],
            [['nav_name'], 'string', 'max' => 100],
            [['nav_link', 'nav_logo'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nav_id' => Yii::t('app', 'Nav ID'),
            'nav_name' => Yii::t('app', 'Nav Name'),
            'nav_type' => Yii::t('app', 'Nav Type'),
            'nav_link' => Yii::t('app', 'Nav Link'),
            'nav_logo' => Yii::t('app', 'Nav Logo'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'order_no' => Yii::t('app', 'Order No'),
        ];
    }
}
