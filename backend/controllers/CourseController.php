<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\Course;
use backend\models\YiiForum;
use backend\models\ResetPasswordForm;
use yii\web\NotFoundHttpException;


class CourseController extends BaseController
{ 
	//课程列表
	public function actionList(){
		$query =  Course::find();
		$searchUrlArr = [];
        $searchArr = $this->_getSearchCondition($searchUrlArr);
        $config = [
                'pageSize' => Yii::$app->params['pageSize'],
                'where'=>$searchArr,
                'urlWhere'=>$searchUrlArr,
                'order' => 'course_id ASC',
            ];
        $locals = YiiForum::getPagedRows($query,$config);
		return $this->render('list',$locals);
	}

    //创建课程信息
    public function actionCreate()
    {
        $model = new Course();
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->save()){
                return $this->redirect(['list']);             
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

    //修改课程信息
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->save()){
                return $this->redirect(['list']);                
            }else{
                return $this->render('update', ['model' => $model]);                
            }

        }else{
            return $this->render('update', ['model' => $model]);
        }
    }

    //查看课程信息
    public function actionView($id){
        $model = $this->findModel($id);
        return $this->render('view',['model'=>$model]);
    }

    //删除课程
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
        if (($model = Course::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionImport(){
        $fileType = $_FILES['course']['type'];
        if($fileType!='text/csv'){
            return json_encode(['errno'=>2,'errmsg'=>'文件格式不正确']);
        }
        $uploadInfo = YiiForum::uploadFiles('course');
        if($uploadInfo['errno']==0){
            $fileUrl = $uploadInfo['fileInfo'][0]['fileUrl'];
            $admissions = $this->formatCourse('.'.$fileUrl);
            if($admissions){
                foreach ($admissions as $key => $value) {
                    $model = new Course();
                    $model->attributes = $value;
                    $ret = $model->save();
                    if(!$ret){
                        Yii::error('insert course faild,insertArr='.json_encode($value).',error='.json_encode($model->getErrors()));
                    }
                }
            }
            return json_encode(['errno'=>0,'errmsg'=>'导入完成']);
        }

        return json_encode(['errno'=>1,'errmsg'=>'导入失败']);
    }


    public function formatCourse($fileUrl)
    {
        if(!file_exists($fileUrl))
            return [];
        $reader = \PHPExcel_IOFactory::createReader('Excel2007');
        $reader->setReadDataOnly(true);
        $objPHPExcel = $reader->load($fileUrl);
        $all = $objPHPExcel->getActiveSheet()->getHighestRow();
        //var_dump($sheetData);
        if($all>0){
            $columnArr = [
                'A' => 'course_name',
                'B' => 'class_room',
                'C' => 'teacher',
                'D' => 'section',
                'E' => 'class_name',
                'F' => 'academic_year',
                'G' => 'week_day',
                'H' => 'note',
            ];
            $resArr = [];
            foreach ($this->xrange(2, $all) as $i) {
                $arr = [];
                foreach ($columnArr as $k=>$v) {
                    $data = $objPHPExcel->getActiveSheet()->getCell($k.$i)->getFormattedValue();
                    if(in_array($v, ['academic_year','week_day'])){
                        $arr[$v] = (int)$data;
                    }else{
                        $arr[$v] = (string)$data;  
                    }
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

	/**
     * 封装搜索条件
     */
    private function _getSearchCondition(&$searchUrlArr)
    {
        $arr = ['and',];

        $class_name = Yii::$app->request->post('class_name') ? Yii::$app->request->post('class_name') : Yii::$app->request->get('class_name');
        if($class_name){
            $arr[] = "class_name='{$class_name}'";
            $searchUrlArr['class_name'] = $class_name;
        }

        return count($arr) > 1 ? $arr : [];   
    }

}