<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\Admission;
use backend\models\YiiForum;
use backend\models\ResetPasswordForm;
use yii\web\NotFoundHttpException;


class AdmissionController extends BaseController
{
	//录取列表
	public function actionList(){
		$query =  Admission::find();
		$searchUrlArr = [];
        $searchArr = $this->_getSearchCondition($searchUrlArr);
        $config = [
                'pageSize' => Yii::$app->params['pageSize'],
                'where'=>$searchArr,
                'urlWhere'=>$searchUrlArr,
                'order' => 'admission_id desc',
            ];
        $locals = YiiForum::getPagedRows($query,$config);
		return $this->render('list',$locals);
	}

    //新增录取
    public function actionCreate()
    {
        $model = new Admission();
        if ($model->load(Yii::$app->request->post()))
        {
            $model->create_time = date('Y-m-d H:i:s');
            if($model->save()){
                return $this->redirect([
                        'list' 
                ]);             
            }else{
                return $this->render('create', [
                        'model' => $model,
                ]); 
            }
            
        }else{
            return $this->render('create', [
                    'model' => $model,
            ]);
        }
    }

    //修改录取信息
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->save()){
                return $this->redirect([
                        'list' 
                ]);                
            }else{
                return $this->render('update', [
                        'model' => $model,
                ]);                
            }

        }else{
            return $this->render('update', [
                    'model' => $model,
            ]);
        }
    }

    //查看录取信息
    public function actionView($id){
        $model = $this->findModel($id);
        return $this->render('view',['model'=>$model]);
    }
    
    //删除录取信息
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
        // var_dump(User::findOne($id));die;
        if (($model = Admission::findOne($id)) !== null)
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
        $real_name = Yii::$app->request->post('real_name') ? Yii::$app->request->post('real_name') : Yii::$app->request->get('real_name');
        if($real_name){
            $arr[] = ['like', 'real_name', $real_name];
            $searchUrlArr['real_name'] = $real_name;
        }

        $accept_major = Yii::$app->request->post('accept_major') ? Yii::$app->request->post('accept_major') : Yii::$app->request->get('accept_major');
        if($accept_major){
            $arr[] = ['like', 'accept_major', $accept_major];
            $searchUrlArr['accept_major'] = $accept_major;
        }

        return count($arr) > 1 ? $arr : [];    
    }

}