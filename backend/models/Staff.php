<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "staff".
 *
 * @property string $staff_id
 * @property integer $sex
 * @property string $real_name
 * @property integer $dept_id
 * @property string $intro
 * @property string $details
 * @property string $logo
 * @property integer $is_index
 * @property integer $order_no
 * @property integer $staff_type
 * @property string $staff_title
 */
class Staff extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'staff';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex', 'dept_id', 'is_index', 'order_no', 'staff_type'], 'integer'],
            [['intro', 'details'], 'string'],
            [['real_name', 'staff_title'], 'string', 'max' => 100],
            [['logo'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'staff_id' => Yii::t('app', 'Staff ID'),
            'sex' => Yii::t('app', 'Sex'),
            'real_name' => Yii::t('app', 'Real Name'),
            'dept_id' => Yii::t('app', 'Dept ID'),
            'intro' => Yii::t('app', 'Intro'),
            'details' => Yii::t('app', 'Details'),
            'logo' => Yii::t('app', 'Logo'),
            'is_index' => Yii::t('app', 'Is Index'),
            'order_no' => Yii::t('app', 'Order No'),
            'staff_type' => Yii::t('app', 'Staff Type'),
            'staff_title' => Yii::t('app', 'Staff Title'),
        ];
    }
}
