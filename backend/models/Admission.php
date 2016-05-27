<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "admission".
 *
 * @property string $admission_id
 * @property string $real_name
 * @property string $exam_number
 * @property string $identity_card
 * @property string $accept_major
 * @property string $create_time
 */
class Admission extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admission';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_time'], 'safe'],
            [['real_name'], 'string', 'max' => 100],
            [['exam_number'], 'string', 'max' => 32],
            [['identity_card'], 'string', 'max' => 64],
            [['accept_major'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'admission_id' => Yii::t('app', 'Admission ID'),
            'real_name' => Yii::t('app', 'Real Name'),
            'exam_number' => Yii::t('app', 'Exam Number'),
            'identity_card' => Yii::t('app', 'Identity Card'),
            'accept_major' => Yii::t('app', 'Accept Major'),
            'create_time' => Yii::t('app', 'Create Time'),
        ];
    }
}
