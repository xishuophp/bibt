<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\ApplyOnline;
use backend\models\YiiForum;
use backend\models\ResetPasswordForm;
use yii\web\NotFoundHttpException;


class ApplyOnlineController extends BaseController
{
	//报名列表
	public function actionList(){
		$query =  ApplyOnline::find();
		$searchUrlArr = [];
        $searchArr = $this->_getSearchCondition($searchUrlArr);
        $config = [
                'pageSize' => Yii::$app->params['pageSize'],
                'where'=>$searchArr,
                'urlWhere'=>$searchUrlArr,
                'order' => 'apply_id desc',
            ];
        $locals = YiiForum::getPagedRows($query,$config);

        //添加文件缓存
        Yii::$app->cache->set('Apply_'.Yii::$app->user->identity->user_id, $searchArr);
		return $this->render('list',$locals);
	}

    //查看报名信息
    public function actionView($id){
        $model = $this->findModel($id);
        return $this->render('view',['model'=>$model]);
    }
    
    //删除报名信息
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
        if (($model = ApplyOnline::findOne($id)) !== null)
        {
            return $model;
        }
        else
        {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionExport()
    {
        $where = Yii::$app->cache->get('Apply_'.Yii::$app->user->identity->user_id);
        $data = ApplyOnline::find()->where($where)->asArray()->all();
        if(empty($data)){
            return json_encode(['status'=>2,'info'=>'查询结果为空']);
        }else{
           $path =  $this->makeExcle($data);
           return json_encode(['status'=>0,'info'=>$path]); 
        }
    }

    //生成excel文件
    public function makeExcle($data)
    {

            $insert = [
                'A'  => 'real_name',
                'B'  => 'sex',
                'C'  => 'phone',
                'D'  => 'province',
                'E'  => 'city',
                'F'  => 'graduate_school',
                'G'  => 'identity_card',
                'H'  => 'exam_number',
                'I'  => 'apply_major',
                'J'  => 'create_time',
            ];

            $titleArr = [
                'A'  => Yii::t('app', 'Real Name'),
                'B'  => Yii::t('app', 'Sex'),
                'C'  => Yii::t('app', 'Phone'),
                'D'  => Yii::t('app', 'Province'),
                'E'  => Yii::t('app', 'City'),
                'F'  => Yii::t('app', 'Graduate School'),
                'G'  => Yii::t('app', 'Identity Card'),
                'H'  => Yii::t('app', 'Exam Number'),
                'I'  => Yii::t('app', 'Apply Major'),
                'J'  => Yii::t('app', 'Apply Time'),
            ];

        $objPHPExcel = new \PHPExcel();

        $objPHPExcel->getProperties()->setTitle("Apply Info")
                                     ->setSubject("test")
                                     ->setDescription("报名信息");

        foreach($titleArr as $k => $vo){
            $objPHPExcel->setActiveSheetIndex()->setCellValue($k.'1', $vo);
        }

        $objPHPExcel->setActiveSheetIndex()->setTitle('报名信息');

        foreach($titleArr as $k => $v){
            $i = 0;
            foreach($data as $key => $value){
                if($insert[$k]=='sex'){
                    $value[$insert[$k]] = Yii::$app->params['sex'][$value[$insert[$k]]];
                }
                $objPHPExcel->setActiveSheetIndex()->setCellValue($k.($i+2), $value[$insert[$k]]);
                $i++;
            }
        }

        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $path = './upload/export/apply_info.xlsx';
        $objWriter->save($path);
        return $path;
    }

    //下载excel文件
    public function actionDownload()
    {
        $path = Yii::$app->request->get('path');
        if(!empty($path) && file_exists($path) && is_file($path)){
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="apply_info.xlsx"');
            header('Content-Length: ' . filesize($path));
            header('Content-Transfer-Encoding: binary');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            readfile($path);
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

        $apply_major = Yii::$app->request->post('apply_major') ? Yii::$app->request->post('apply_major') : Yii::$app->request->get('apply_major');
        if($apply_major){
            $arr[] = ['like', 'apply_major', $apply_major];
            $searchUrlArr['apply_major'] = $apply_major;
        }

        return count($arr) > 1 ? $arr : [];    
    }

}