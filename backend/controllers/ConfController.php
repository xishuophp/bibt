<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\SysConfig;
use backend\models\YiiForum;
use backend\models\ResetPasswordForm;
use yii\web\NotFoundHttpException;


class ConfController extends BaseController
{
	//配置列表
	public function actionIndex(){
		$rows = SysConfig::find()->asArray()->all();
		$res = [];
		foreach ($rows as $key => $value) {
			$res[$value['config_name']] = [$value['config_id'],$value['config_value']];
		}
		// var_dump($res);die;
		return $this->render('index',['res'=>$res]);
	}

	//添加、修改配置
	public function actionUpdate(){
		$configs = Yii::$app->request->post('config');
		$data = array_filter(explode('@',$configs));
		foreach ($data as $key => $value) {
			$config = explode('#',$value);
			if(!empty($config[0])){
				//如果配置已存在,修改配置
				$model = $this->findModel($config[0]);
				if($config[2] == "true"){
					$model->config_value = '1';
				}elseif($config[2] == 'false'){
					$model->config_value = '0';
				}else{
					if(empty($config[2])) return json_encode(['data'=>2,'errmsg'=>'配置项的值不能为空!']);
					$model->config_value = $config[2];
				}
				$model->save();
			}else{
				//如果配置不存在,添加配置
				$newModel = new SysConfig();
				$newModel->config_name = $config[1];
				if($config[2] == "true"){
					$newModel->config_value = '1';
				}elseif($config[2] == 'false'){
					$newModel->config_value = '0';
				}else{
					$newModel->config_value = $config[2];
				}
				$newModel->save();
			}
			// var_dump($config);
		}
		return json_encode(['data'=>1]);
	}

	//配置表单查询
	protected function findModel($id)
    {
        if (($model = SysConfig::findOne(['config_id'=>$id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}