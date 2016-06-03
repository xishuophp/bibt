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
		$config_names = [];
        $ret = SysConfig::find()->asArray()->all();
        foreach ($ret as $key => $value) {
        	$config_names[] = $value['config_name'];
        }
		foreach ($data as $key => $value) {
			$config = explode('#',$value);
			if(!empty($config_names) && in_array($config[0], $config_names)){
				//如果配置已存在,修改配置
				$model = SysConfig::findOne(['config_name'=>$config[0]]);
				if($config[1] == "true"){
					$model->config_value = '1';
				}elseif($config[1] == 'false'){
					$model->config_value = '0';
				}else{
					$model->config_value = $config[1];
				}
				$model->save();
			}else{
				//如果配置不存在,添加配置
				$newModel = new SysConfig();
				$newModel->config_name = $config[0];
				if($config[1] == "true"){
					$newModel->config_value = '1';
				}elseif($config[1] == 'false'){
					$newModel->config_value = '0';
				}else{
					$newModel->config_value = $config[1];
				}
				$newModel->save();
			}
		}
		return json_encode(['data'=>1]);
	}

}