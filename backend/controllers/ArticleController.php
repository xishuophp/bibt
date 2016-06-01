<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use common\models\Article;
use common\models\ArticleCategory;
use backend\models\YiiForum;
use backend\models\ServiceArticle;
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
        $ServiceArticleModel = new ServiceArticle();
        $categorys = $ServiceArticleModel->getCategoryList();
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
                return $this->render('create',['model'=>$model,'categorys'=>$categorys]);
            }

        }else{
            return $this->render('create',['model'=>$model,'categorys'=>$categorys]);
        }
    }

    //修改文章
    public function actionUpdate($id) {
        $model = $this->findModel($id);
        $publish_date = $model->publish_date;
        $ServiceArticleModel = new ServiceArticle();
        $categorys = $ServiceArticleModel->getCategoryList();
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
                return $this->render('update',['model'=>$model,'categorys'=>$categorys]);
            }
        }else{
            return $this->render('update',['model'=>$model,'categorys'=>$categorys]);
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

    //文章分类列表
    public function actionCategoryList()
    {
        $query =  ArticleCategory::find();
        $searchUrlArr = [];
        $searchArr = $this->_getSearchCondition($searchUrlArr);
        $config = [
                'pageSize' => Yii::$app->params['pageSize'],
                'where'=>$searchArr,
                'urlWhere'=>$searchUrlArr,
                'order' => 'category_id desc',
            ];
        $locals = YiiForum::getPagedRows($query,$config);
        return $this->render('category_list',$locals);
    }

    //添加文章分类
    public function actionCategoryCreate()
    {
        $model = new ArticleCategory();
        $ServiceArticleModel = new ServiceArticle();
        $categorys = $ServiceArticleModel->getCategoryList();
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->save()){
                return $this->redirect([
                        'category-list' 
                ]);             
            }else{
                return $this->render('category_create', [
                        'model'=>$model,'categorys'=>$categorys
                ]); 
            }
            
        }else{
            return $this->render('category_create', [
                    'model'=>$model,'categorys'=>$categorys
            ]);
        }
    }

    //修改文章分类
    public function actionCategoryUpdate($id)
    {
        $model = ArticleCategory::findOne($id);
        if ($model === null){
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $ServiceArticleModel = new ServiceArticle();
        $categorys = $ServiceArticleModel->getCategoryList();
        if ($model->load(Yii::$app->request->post()))
        {
            if($model->save()){
                return $this->redirect([
                        'category-list' 
                ]);             
            }else{
                return $this->render('category_update', [
                        'model'=>$model,'categorys'=>$categorys
                ]); 
            }
            
        }else{
            return $this->render('category_update', [
                    'model'=>$model,'categorys'=>$categorys
            ]);
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

        $category_name = Yii::$app->request->post('category_name') ? Yii::$app->request->post('category_name') : Yii::$app->request->get('category_name');
        if($category_name){
            $arr[] = ['like', 'category_name', $category_name];
            $searchUrlArr['category_name'] = $category_name;
        }

        return count($arr) > 1 ? $arr : [];   
    }

}