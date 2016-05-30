<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "apply_online".
 *
 * @property string $apply_id
 * @property string $real_name
 * @property integer $sex
 * @property string $phone
 * @property string $province
 * @property string $city
 * @property string $graduate_school
 * @property string $identity_card
 * @property string $exam_number
 * @property string $apply_major
 * @property string $create_time
 * @property string $notes
 */
class ApplyOnline extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'apply_online';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex'], 'integer'],
            [['create_time'], 'safe'],
            [['real_name', 'identity_card', 'apply_major'], 'required'],
            [['notes'], 'string'],
            [['real_name', 'province', 'city'], 'string', 'max' => 100],
            [['phone'], 'string', 'max' => 150],
            [['graduate_school'], 'string', 'max' => 300],
            [['identity_card'], 'string', 'max' => 64],
            [['exam_number'], 'string', 'max' => 32],
            [['apply_major'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'apply_id' => Yii::t('app', 'Apply ID'),
            'real_name' => Yii::t('app', 'Real Name'),
            'sex' => Yii::t('app', 'Sex'),
            'phone' => Yii::t('app', 'Phone'),
            'province' => Yii::t('app', 'Province'),
            'city' => Yii::t('app', 'City'),
            'graduate_school' => Yii::t('app', 'Graduate School'),
            'identity_card' => Yii::t('app', 'Identity Card'),
            'exam_number' => Yii::t('app', 'Exam Number'),
            'apply_major' => Yii::t('app', 'Apply Major'),
            'create_time' => Yii::t('app', 'Create Time'),
            'notes' => Yii::t('app', 'Notes'),
        ];
    }
}
