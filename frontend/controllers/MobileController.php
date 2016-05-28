<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;


/**
 * Site controller
 */
class MobileController extends Controller
{
    /**
     * 首页
     * @return [type] [description]
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * 师资队伍
     * @return [type] [description]
     */
    public function actionTeacherTeam()
    {
        $queryModel = new \yii\db\Query;
        $teacherArr = $queryModel->from(\backend\models\Staff::tableName())->select('staff_id,real_name,intro')->all();
        
        return $this->render('teacher_list',[
                'teacherArr' => $teacherArr,
            ]);
    }
    /**
     * 教师详细介绍
     * @return [type] [description]
     */
    public function actionTeacherDetail($tid)
    {
        $teacherModel = \backend\models\Staff::findOne((int)$tid);
        return $this->render('teacher_detail',[
                'model' => $teacherModel,
            ]);
    }

    /**
     * 院系介绍
     */
    public function actionDepartmentIntroduction()
    {
        $queryModel = new \yii\db\Query;
        $deptArr = $queryModel->from(\backend\models\Department::tableName())->select('dept_id,dept_name,dept_intro')->all();
        
        return $this->render('dept_list',[
                'deptArr' => $deptArr,
            ]);
    }

    /**
     * 院系详情
     */
    public function actionDepartmentDetail($dept_id)
    {
        $deptModel = \backend\models\Department::findOne($dept_id);
        return $this->render('dept_detail',[
                'model' => $deptModel,
            ]);
    }

    /**
     * 在线报名
     */
    public function actionOnlineApplication()
    {
        $model = new \backend\models\ApplyOnline;
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->save()){
                return $this->redirect([
                        'mobile/index' 
                ]);             
            }else{
                return $this->render('online-application', [
                        'model' => $model,
                ]); 
            }
            
        }
        return $this->render('online_application',[
                'model' => $model,
            ]);
    }
}