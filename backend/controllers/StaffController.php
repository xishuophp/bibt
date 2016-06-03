<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\Staff;
use backend\models\YiiForum;
use backend\models\ServiceStaff;
use backend\models\ResetPasswordForm;
use yii\web\NotFoundHttpException;


class StaffController extends BaseController
{
    public function actions()
    {
        return [
            'Kupload' => [
                'class' => 'pjkui\kindeditor\KindEditorAction',
            ]
        ];
    }
    
	//员工列表
	public function actionList(){
		$query =  Staff::find();
		$searchUrlArr = [];
        $searchArr = $this->_getSearchCondition($searchUrlArr);
        $config = [
                'pageSize' => Yii::$app->params['pageSize'],
                'where'=>$searchArr,
                'urlWhere'=>$searchUrlArr,
                'order' => 'dept_id desc',
            ];
        $locals = YiiForum::getPagedRows($query,$config);
		return $this->render('list',$locals);
	}

    //新增员工
    public function actionCreate()
    {
        $model = new Staff();
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->save()){
                //更新员工缓存信息
                ServiceStaff::updateCateForStaff();
                return $this->redirect(['list']);             
            }else{
                return $this->render('create', ['model' => $model,]); 
            }
            
        }else{
            return $this->render('create', [
                    'model' => $model,
            ]);
        }
    }

    //修改员工信息
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->save()){
                //更新员工缓存信息
                ServiceStaff::updateCateForStaff();
                return $this->redirect(['list']);                
            }else{
                return $this->render('update', ['model' => $model,]);                
            }

        }else{
            return $this->render('update', [
                    'model' => $model,
            ]);
        }
    }

    //查看员工信息
    public function actionView($id){
        $model = $this->findModel($id);
        return $this->render('view',['model'=>$model]);
    }

    //删除员工
    public function actionDelete()
    {
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);
        if($model->delete()){
            return json_encode(['errno'=>0,'errmsg'=>'删除成功']);
        }else{
            return json_encode(['errno'=>1,'errmsg'=>'删除失败']);
        }
    }

    protected function findModel($id)
    {
        if (($model = Staff::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

	/**
     * 封装搜索条件
     */
    private function _getSearchCondition(&$searchUrlArr)
    {
        $arr = ['and',];

        $staff_type = Yii::$app->request->post('staff_type') ? Yii::$app->request->post('staff_type') : Yii::$app->request->get('staff_type');
        if($staff_type){
             $arr[] = "staff_type='{$staff_type}'";
             $searchUrlArr['staff_type'] = $staff_type;
        }

        $real_name = Yii::$app->request->post('real_name') ? Yii::$app->request->post('real_name') : Yii::$app->request->get('real_name');
        if($real_name){
             $arr[] = ['like', 'real_name', $real_name];
             $searchUrlArr['real_name'] = $real_name;
        }

        return count($arr) > 1 ? $arr : [];   
    }

}