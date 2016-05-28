<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "department".
 *
 * @property string $dept_id
 * @property string $dept_name
 * @property integer $parent_id
 * @property integer $dept_type
 * @property string $dept_intro
 * @property string $dept_details
 * @property string $dept_phone
 * @property integer $dept_leader
 * @property integer $is_index
 * @property integer $order_no
 */
class Department extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'department';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'dept_type', 'dept_leader', 'is_index', 'order_no'], 'integer'],
            [['dept_name'], 'required'],
            [['dept_intro', 'dept_details'], 'string'],
            [['dept_name'], 'string', 'max' => 300],
            [['dept_phone'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'dept_id' => Yii::t('app', 'Dept ID'),
            'dept_name' => Yii::t('app', 'Dept Name'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'dept_type' => Yii::t('app', 'Dept Type'),
            'dept_intro' => Yii::t('app', 'Dept Intro'),
            'dept_details' => Yii::t('app', 'Dept Details'),
            'dept_phone' => Yii::t('app', 'Dept Phone'),
            'dept_leader' => Yii::t('app', 'Dept Leader'),
            'is_index' => Yii::t('app', 'Is Index'),
            'order_no' => Yii::t('app', 'Order No'),
        ];
    }
}
