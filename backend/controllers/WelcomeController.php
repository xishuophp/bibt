<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\base\YiiForum;

/**
 * 后台基础controller，后台所有的controller继承此controller
 *
 */
class WelcomeController extends BaseController
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * 语言切换
     */
    public function actionLanguage(){
        $language=  \Yii::$app->request->get('lang');
        // var_dump($language);die;
        if(isset($language) && in_array($language, Yii::$app->params['languageArr'])){
            \Yii::$app->session['language']=$language;
        }
        //哪里来的返回到哪
        $this->goBack(\Yii::$app->request->headers['Referer']);
    }
}
