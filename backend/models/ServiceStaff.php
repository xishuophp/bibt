<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\Staff;
use backend\models\YiiForum;

class ServiceStaff extends Model
{
    //更新缓存
    public static function updateCateForStaff()
    {
        $staff = Staff::find()->asArray()->all();
        $staffList = [];
        foreach ($staff as $key => $value) {
            $staffList[$value['staff_id']] = $value['real_name'];
        }
        Yii::$app->cache->set(Yii::$app->params['staffList'], $staffList);
    }
}