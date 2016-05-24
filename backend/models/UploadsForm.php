<?php

namespace backend\models;

use Yii;
use yii\base\Model;

class UploadsForm extends Model
{
    public $file;

    public function rules(){

        return [
            [['file'],'file', 'maxFiles' => 10],
        ];
    }



}