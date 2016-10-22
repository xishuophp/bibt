<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\SysConfig;
use common\models\Article;
use backend\models\YiiForum;

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
        $locals = [
            'bannerArr' => [],
            'bannerIndex' => 2,
        ];
        //查询查询banner图
        $configModel = SysConfig::findOne(['config_name'=>'index_banner1']);
        $config1 = $configModel->config_value;
        $configArr = [];
        if($config1){
            $configArr = explode(',', $config1);
        }
        if($configArr){
            $queryModel = new \yii\db\Query;
            $where = ['in', 'article_id', $configArr];
            $articleArr = $queryModel->from(Article::tableName())->select('article_id,article_title,article_logo')->all();
            if(!$articleArr){
                $locals['bannerArr'] = $this->getBannerArr2();
            }else{
                $locals['bannerArr'] = $articleArr;
                $locals['bannerIndex'] = 1;
            }
            
        }else{
            $locals['bannerArr'] = $this->getBannerArr2();
        }
        
        return $this->render('index', $locals);
    }
    /**
     * 学院简介
     * @return [type] [description]
     */
    public function actionIntro()
    {
        $configModel = SysConfig::findOne(['config_name'=>'index_intro']);
        $postid = $configModel ? (int)$configModel->config_value : 0;
        $postModel = null;
        if($postid > 0){
            $postModel = Article::findOne($postid);
        }
        return $this->render('article_detail', ['model'=>$postModel]);
    }
    /**
     * 校园风光
     */
    public function actionCampus()
    {
        $configModel = SysConfig::findOne(['config_name'=>'index_campus']);
        $postid = $configModel ? (int)$configModel->config_value : 0;
        $postModel = null;
        if($postid > 0){
            $postModel = Article::findOne($postid);
        }
        return $this->render('article_detail', ['model'=>$postModel]);        
    }
    /**
     * 就业风采
     */
    public function actionJob()
    {
        $configModel = SysConfig::findOne(['config_name'=>'index_job']);
        $postid = $configModel ? (int)$configModel->config_value : 0;
        $postModel = null;
        if($postid > 0){
            $postModel = Article::findOne($postid);
        }
        return $this->render('article_detail', ['model'=>$postModel]);        
    }

    public function actionEmploy()
    {
        $configModel = SysConfig::findOne(['config_name'=>'index_emply']);
        $postid = $configModel ? (int)$configModel->config_value : 0;
        $postModel = null;
        if($postid > 0){
            $postModel = Article::findOne($postid);
        }
        return $this->render('article_detail', ['model'=>$postModel]);        
    }

    /**
     * 就业风采列表
     */
    public function actionJobList()
    {
        return $this->render('job_list');
    }

    /**
     * 新闻公告
     * @return [type] [description]
     */
    public function actionNotice()
    {
        return $this->render('notice_list');
    }

    /**
     * 获取资讯详情
     */
    public function actionGetNoticeList()
    {
        $this->layout = false;
        $configModel = SysConfig::findOne(['config_name'=>'index_notice']);
        $cateid = $configModel ? (int)$configModel->config_value : 0;
        $query =  Article::find();
        $searchUrlArr = [];
        $searchArr = [
            'article_category' => $cateid,
        ];
        $config = [
                'pageSize' => 10,
                'where'=>$searchArr,
                'urlWhere'=>$searchUrlArr,
                'order' => 'article_id desc',
            ];
        $locals = YiiForum::getPagedRows($query,$config);
        
        $content = $this->render('get_notice',$locals);
        $resArr = [
            'status' => 0,
            'rows' => $content,
        ];
        $page = Yii::$app->request->get('page');
        $total = $locals['pages']->totalCount;
        if( $total > $page+1 ){
            $nextPage = $page + 1;
        }else{
            $nextPage = 0;
        }
        $resArr['nextPage'] = $nextPage;
        return json_encode($resArr);
    }
    /**
     * 资讯详情
     * @param  [type] $aid [description]
     * @return [type]      [description]
     */
    public function actionArticleDetail($aid)
    {
        $postModel = Article::findOne(intval($aid));
        return $this->render('article_detail', [
                'model' => $postModel,
            ]);
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
    /**
     * 录取查询
     * @return [type] [description]
     */
    public function actionAccept()
    {
        //查询录取查询状态
        $configModel = SysConfig::findOne(['config_name'=>'index_accept']);
        $acceptStatus = $configModel ? (int)$configModel->config_value : 0;
        if(!$acceptStatus){
            return $this->sysError('录取查询暂未开启，请稍后再试');
        }
        $model = new \frontend\models\AcceptForm;
        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            //执行查询操作
            $where = [
                'real_name' => trim($model->real_name),
                'other_number' => trim($model->exam_number),
                'identity_card' => trim($model->identity_card),
            ];
            $acceptModel = \backend\models\Admission::findOne($where);
            return $this->render('accept_result',[
                    'model' => $acceptModel,
                ]);
            
        }
        return $this->render('accept',[
                'model' => $model,
            ]);
    }
    /**
     * 课表查询
     * @return [type] [description]
     */
    public function actionCourse()
    {
        $class_name = Yii::$app->request->post('class_name', '');
        $class_grade = Yii::$app->request->post('class_grade', '');
        if($class_name){
            $sql = "select * from course where class_name=:class_name and class_grade=:class_grade order by week_day asc,class_time asc";
            $command = Yii::$app->db->createCommand($sql,[':class_name'=>$class_name, ':class_grade'=>$class_grade]);
            $courseArr = $command->queryAll();
            return $this->render('select_course', [
                    'courseArr' => $courseArr
                ]);
        }else{
            $sql = "select class_grade from course group by class_grade order by class_grade";
            $gradeArr = Yii::$app->db->createCommand($sql)->queryAll();
            //var_dump($classArr);die();
            return $this->render('course',[
                    'gradeArr' => $gradeArr
                ]);
        }
        
    }

    public function actionClass()
    {
        $this->layout = false;
        $class_grade = Yii::$app->request->get('grade_name', '');
        if(!$class_grade){
            return json_encode(['status'=>1, 'content'=>'']);
        }
        $sql = 'select class_name from course where class_grade=:class_grade group by class_name';
        $classArr = Yii::$app->db->createCommand($sql)->bindValue(':class_grade', $class_grade)->queryAll();
        $html = '';
        foreach($classArr as $class){
            $html .='<option value="'.$class['class_name'].'">'.$class['class_name'].'</option>';
        }

        return json_encode(['status'=>0,'content'=>$html]);
    }



    public function sysError($errorMsg)
    {
        $this->layout = false;
        $locals = [];
        $locals['errorMsg'] = $errorMsg;
        return $this->render('error', $locals);
    }

    private function getBannerArr2()
    {
        $configModel = SysConfig::findOne(['config_name'=>'index_banner2']);
        $config2 = $configModel->config_value;
        $bannerArr = explode("\n", $config2);
        if(!$bannerArr){
            $bannerArr = [
                '/static/images/show01.jpg',
                '/static/images/show02.jpg',
                '/static/images/show03.jpg',
                '/static/images/show04.jpg',
                '/static/images/show05.jpg',
            ];
        }
        return $bannerArr;
    }


}