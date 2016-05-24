<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use backend\models\User;
use backend\models\YiiForum;
use backend\models\ResetPasswordForm;


class UserController extends BaseController
{
	//用户列表
	public function actionList(){
		$query =  User::find();
		$searchUrlArr = [];
        $searchArr = $this->_getSearchCondition($searchUrlArr);
        $config = [
                'pageSize' => Yii::$app->params['pageSize'],
                'where'=>$searchArr[0],
                'urlWhere'=>$searchArr[1],
                'order' => 'user_id desc',
            ];
        $locals = YiiForum::getPagedRows($query,$config);
		return $this->render('list',$locals);
	}

    //用户个人信息
    public function actionInfo(){
        $model = User::findOne(['user_id'=>Yii::$app->user->identity->user_id]);
        if($model){
            if($model->load(Yii::$app->request->post())){
                $avatar = YiiForum::uploadFiles('avatar');
                if($avatar['errno']==0){
                    $model->avatar = json_encode($avatar['fileInfo']);
                }
                if($model->save()){
                    echo '<script>location.href="/index.php?r=user/info"</script>';
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
            // $model->generateAuthKey();
            // $model->signup();
            if($model->save()){
                return json_encode(['status'=>0,'content'=>'success']);
            }else{
                return json_encode(['status'=>1,'content'=>'failed']);
            }
        }else{
            return json_encode(['status'=>2,'content'=>'userid error']);
        }
        
    }

	/**
     * 封装搜索条件
     */
    private function _getSearchCondition($searchUrlArr)
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

        return count($arr) > 1 ? [$arr,$searchUrlArr] : ['',$searchUrlArr];    
    }

}