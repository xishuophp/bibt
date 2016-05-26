<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\Nav;
use backend\models\YiiForum;
use backend\models\ResetPasswordForm;
use yii\web\NotFoundHttpException;


class NavController extends BaseController
{
    /**
     * 导航列表
     * @return [type] [description]
     */
    public function actionList(){
        $query =  Nav::find();
        $searchUrlArr = [];
        $searchArr = $this->_getSearchCondition($searchUrlArr);
        $config = [
                'pageSize' => Yii::$app->params['pageSize'],
                'where'=>$searchArr,
                'urlWhere'=>$searchUrlArr,
                'order' => 'nav_id desc',
            ];
        $locals = YiiForum::getPagedRows($query,$config);
        return $this->render('list',$locals);
    }

    /**
     * 添加导航
     * @return [type] [description]
     */
    public function actionCreate()
    {
        $model = new Nav();
        if ($model->load(Yii::$app->request->post()))
        {
            $navLogo = YiiForum::uploadFiles('logo');
            if($navLogo['errno']==0){
                $model->nav_logo = json_encode($navLogo['fileInfo']);
            }
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

    //修改部门信息
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()))
        {
            $navLogo = YiiForum::uploadFiles('logo');
            if($navLogo['errno']==0){
                $model->nav_logo = json_encode($navLogo['fileInfo']);
            }
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

    //删除部门
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
        if (($model = Nav::findOne($id)) !== null)
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

        $dept_type = Yii::$app->request->post('dept_type') ? Yii::$app->request->post('dept_type') : Yii::$app->request->get('dept_type');
        if($dept_type){
             $arr[] = "dept_type='{$dept_type}'";
             $searchUrlArr['dept_type'] = $dept_type;
        }

        $dept_name = Yii::$app->request->post('dept_name') ? Yii::$app->request->post('dept_name') : Yii::$app->request->get('dept_name');
        if($dept_name){
             $arr[] = ['like', 'dept_name', $dept_name];
             $searchUrlArr['dept_name'] = $dept_name;
        }

        return count($arr) > 1 ? $arr : [];   
    }    

}