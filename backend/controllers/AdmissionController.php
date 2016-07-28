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

    public function actionImport(){
        $fileType = $_FILES['admission']['type'];
        if($fileType!='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'){
            return json_encode(['errno'=>2,'errmsg'=>'文件格式不正确']);
        }
        $uploadInfo = YiiForum::uploadFiles('admission');
        if($uploadInfo['errno']==0){
            $fileUrl = $uploadInfo['fileInfo'][0]['fileUrl'];
            $admissions = $this->formatAdmission('.'.$fileUrl);
            if($admissions){
                foreach ($admissions as $key => $value) {
                    $model = new Admission();
                    $model->attributes = $value;
                    $model->create_time = date('Y-m-d H:i:s');
                    $model->accept_year = (int)date('Y');
                    $ret = $model->save();
                    if(!$ret){
                        Yii::error('insert admission faild,insertArr='.json_encode($value).',error='.json_encode($model->getErrors()));
                    }
                }
            }
            return json_encode(['errno'=>0,'errmsg'=>'导入完成']);
        }

        return json_encode(['errno'=>1,'errmsg'=>'导入失败']);
    }


    public function formatAdmission($fileUrl)
    {
        if(!file_exists($fileUrl))
            return [];
        $reader = \PHPExcel_IOFactory::createReader('Excel2007');
        $reader->setReadDataOnly(true);
        $objPHPExcel = $reader->load($fileUrl);
        $all = $objPHPExcel->getActiveSheet()->getHighestRow();
        if($all>0){
            $columnArr = [
                'B' => 'real_name',
                'C' => 'exam_number',
                'D' => 'identity_card',
                'E' => 'accept_major',
            ];
            $resArr = [];
            foreach ($this->xrange(2, $all) as $i) {
                $arr = [];
                foreach ($columnArr as $k=>$v) {
                    $data = $objPHPExcel->getActiveSheet()->getCell($k.$i)->getFormattedValue();
                    $arr[$v] = (string)$data;
                    unset($data);
                }
                $resArr[] = $arr;
            }
            return $resArr;
        }else{
            return [];
        }
    }

    private function xrange($start, $end, $step = 1) {
        for ($i = $start; $i <= $end; $i += $step) {
            yield $i;
        }
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