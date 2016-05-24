<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\YiiForum;

/**
 * 基础Base，其他的全部继承此Base
 */
class BaseController extends Controller
{
    private $admin_user = [];

    public function init()
    {
        parent::init();

        //判断登陆
        if (\Yii::$app->user->isGuest){
            header("Location:/index.php?r=site/login");
            exit;
        }

        if(Yii::$app->request->isAjax){
            $this->enableCsrfValidation = false;
        }

        $this->admin_user = Yii::$app->params['systemAdmin'];
        //权限验证
        @$route = $_GET['r'];
        $routeArr = explode('/',$route);
        $controller = !empty($routeArr[0]) ? $routeArr[0] : 'welcome';
        $ac = !empty($routeArr[1]) ? $routeArr[1] : 'index';
        $permission = strtolower($controller.'_'.$ac);
        if(!in_array(Yii::$app->user->identity->username, $this->admin_user) && YII_ENV_PROD){
            if(!in_array($permission,$this->default_permission)){
                if(!YiiForum::checkAccess($permission)){
                    if(Yii::$app->request->isAjax){
                        echo json_encode(['status'=>1,'content'=>'You do not have permission']);
                        exit;
                    }else{
                        return $this->redirect(['/site/sys-error']);
                    }    
                } 
            }
        }
    }

}