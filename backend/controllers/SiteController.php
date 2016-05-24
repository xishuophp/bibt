<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\LoginForm;
use backend\models\User;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->layout = false;
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if($model->load(Yii::$app->request->post())){
            $user = User::findOne(['username'=>$model->username]);
            if($user === null){
                if(in_array($model->username, Yii::$app->params['systemAdmin'])){
                    $user_info = new User();
                    $user_info->username = $model->username;
                    $user_info->setPassword('123456');
                    $user_info->generateAuthKey();
                    $user_info->signup();
                    $user_info->save();
                }else{ 
                    $model->addError('password','Incorrect username or password');
                    return $this->render('login',['model'=>$model,]);   
                }
            }
            //执行账号登陆
            if($model->login()){
                return $this->goBack();
            }

        }
            
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
