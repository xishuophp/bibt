<?php
namespace frontend\models;

use yii\base\Model;

/**
 * Signup form
 */
class AcceptForm extends Model
{
    public $real_name;
    public $exam_number;
    public $identity_card;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['real_name', 'required'],
            ['exam_number', 'required'],
            ['identity_card', 'required'],
        ];
    }

}
