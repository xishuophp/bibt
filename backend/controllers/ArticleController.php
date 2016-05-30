<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\Article;
use backend\models\YiiForum;
use backend\models\ResetPasswordForm;
use yii\web\NotFoundHttpException;


class ArticleController extends BaseController
{
    public function actions()
    {
        return [
            'Kupload' => [
                'class' => 'pjkui\kindeditor\KindEditorAction',
            ]
        ];
    }
    
	//文章列表
	public function actionList(){
		$query =  Article::find();
		$searchUrlArr = [];
        $searchArr = $this->_getSearchCondition($searchUrlArr);
        $config = [
                'pageSize' => Yii::$app->params['pageSize'],
                'where'=>$searchArr,
                'urlWhere'=>$searchUrlArr,
                'order' => 'article_id desc',
            ];
        $locals = YiiForum::getPagedRows($query,$config);
		return $this->render('list',$locals);
	}

    //发布文章
    public function actionCreate() {
        $model = new Article;
        if($model->load(Yii::$app->request->post())){
            $attachment = YiiForum::uploadFiles('attachment');
            if($attachment['errno']==0){
                $model->article_attachment = json_encode($attachment['fileInfo']);
            }
            $model->create_time = date('Y-m-d H:i:s');
            $dateStr = substr($model->publish_date,-2);
            $dateStr2 = substr($model->publish_date,0,-3);

            if($dateStr == "AM"){
                $model->publish_date = date("Y-m-d H:i:s",strtotime($dateStr2));
            }elseif($dateStr == "PM"){
                $model->publish_date = date("Y-m-d H:i:s",strtotime("+12hours",strtotime($dateStr2)));
            }else{
                $model->publish_date = date("Y-m-d H:i:s");
            }

            $model->article_author = Yii::$app->user->identity->username;

            if($model->save()){
                return $this->redirect(['list']);
            }else{
                return $this->render('create',['model'=>$model]);
            }

        }else{
            return $this->render('create',['model'=>$model]);
        }
    }

    //修改文章
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $publish_date = $model->publish_date;
        if($model->load(Yii::$app->request->post())){
            $attachment = YiiForum::uploadFiles('attachment');
            $attachment2 = [];
            if(isset($_POST['attachment2'])){
                foreach ($_POST['attachment2'] as $key => $value) {
                    $attachment2[] = json_decode($value,true);
                }
            }

            if($attachment['errno']==0){
                $model->article_attachment = json_encode(array_merge($attachment['fileInfo'],$attachment2));
            }else if($attachment2){
                $model->article_attachment = json_encode($attachment2);
            }else{
                $model->article_attachment = '';
            }
            $dateStr = substr($model->publish_date,-2);
            $dateStr2 = substr($model->publish_date,0,-3);

            if($dateStr == "AM"){
                $model->publish_date = date("Y-m-d H:i:s",strtotime($dateStr2));
            }elseif($dateStr == "PM"){
                $model->publish_date = date("Y-m-d H:i:s",strtotime("+12hours",strtotime($dateStr2)));
            }else{
                $model->publish_date = $publish_date;
            }

            $model->update_time = date('Y-m-d H:i:s');

            if($model->save()){
                return $this->redirect(['list']);
            }else{
                return $this->render('update',['model'=>$model]);
            }
        }else{
            return $this->render('update',['model'=>$model]);
        }
    }

    //查看文章信息
    public function actionView($id){
        $model = $this->findModel($id);
        return $this->render('view',['model'=>$model]);
    }

    //删除文章
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
        if (($model = Article::findOne($id)) !== null)
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

        $article_author = Yii::$app->request->post('article_author') ? Yii::$app->request->post('article_author') : Yii::$app->request->get('article_author');
        if($article_author){
             $arr[] = "article_author='{$article_author}'";
             $searchUrlArr['article_author'] = $article_author;
        }

        $article_title = Yii::$app->request->post('article_title') ? Yii::$app->request->post('article_title') : Yii::$app->request->get('article_title');
        if($article_title){
             $arr[] = ['like', 'article_title', $article_title];
             $searchUrlArr['article_title'] = $article_title;
        }

        return count($arr) > 1 ? $arr : [];   
    }

}