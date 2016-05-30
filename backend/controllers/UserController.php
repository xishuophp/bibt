<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\User;
use backend\models\YiiForum;
use backend\models\ResetPasswordForm;
use yii\web\NotFoundHttpException;


class UserController extends BaseController
{
	//用户列表
	public function actionList(){
		$query =  User::find();
		$searchUrlArr = [];
        $searchArr = $this->_getSearchCondition($searchUrlArr);
        $config = [
                'pageSize' => Yii::$app->params['pageSize'],
                'where'=>$searchArr,
                'urlWhere'=>$searchUrlArr,
                'order' => 'user_id desc',
            ];
        $locals = YiiForum::getPagedRows($query,$config);
		return $this->render('list',$locals);
	}

    //创建用户
    public function actionCreate()
    {
        $model = new User();
        if ($model->load(Yii::$app->request->post()))
        {
            $model->setPassword('123456');
            $model->generateAuthKey();
            $model->signup();
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

    //修改用户信息
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post()))
        {
            if(Yii::$app->request->post('reset_password') == 1){
                $model->setPassword('123456');
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

    //用户个人信息
    public function actionInfo(){
        $model = User::findOne(['user_id'=>Yii::$app->user->identity->user_id]);
        if($model){
            if($model->load(Yii::$app->request->post())){
                $avatar = YiiForum::uploadFiles('avatar');
                var_dump($_FILES['avatar']);die;
                if($avatar['errno']==0){
                    $model->avatar = json_encode($avatar['fileInfo']);
                }
                if($model->save()){
                    return $this->redirect([
                        'info' 
                    ]); 
                }else{
                    return $this->render('info',['model'=>$model]);
                }
            }
        }
        return $this->render('info',['model'=>$model]);
    }

    //用户密码修改
    public function actionUpdatePassword(){
        try {
            $model = new ResetPasswordForm(Yii::$app->user->identity->user_id);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', '新密码已保存。');

            return $this->redirect(['user/update-password']);
        }

        $userModel = User::findOne(['user_id'=>Yii::$app->user->identity->user_id]);
        if($userModel){
            return $this->render('update_password',['model'=>$model,'userModel'=>$userModel]);
        }       
    }

    //用户密码重置
    public function actionReset(){
        $id = (int)Yii::$app->request->post('id');
        $model = User::findOne(['user_id'=>$id]);
        if($model){
            $model->setPassword('123456');
            if($model->save()){
                return json_encode(['errno'=>0,'errmsg'=>'重置成功']);
            }else{
                return json_encode(['errno'=>1,'errmsg'=>'重置失败']);
            }
        }else{
            return json_encode(['errno'=>2,'errmsg'=>'userid error']);
        }
        
    }

    
    //删除用户
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
        if (($model = User::findOne($id)) !== null)
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

        $username = Yii::$app->request->post('username') ? Yii::$app->request->post('username') : Yii::$app->request->get('username');
        if($username){
             $arr[] = "username='{$username}'";
             $searchUrlArr['username'] = $username;
        }

        $nickname = Yii::$app->request->post('nickname') ? Yii::$app->request->post('nickname') : Yii::$app->request->get('nickname');
        if($nickname){
             $arr[] = ['like', 'nickname', $nickname];
             $searchUrlArr['nickname'] = $nickname;
        }

        return count($arr) > 1 ? $arr : [];    
    }

}