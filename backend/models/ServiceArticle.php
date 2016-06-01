<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use common\models\ArticleCategory;
use backend\models\YiiForum;

class ServiceArticle extends Model
{
    /**
     * 查询某个分类的名称
     */
    public static function getCategoryName($id){
        $category = ArticleCategory::findOne($id);
        if($category){
            return $category->category_name;
        }else{
            return '';
        }
    }

    public function getCategoryList()
    {
        $categorys = $this->get_categorys_array();
        $ret = $this->getCategoryTree($categorys);
        return $ret;
    }
    //无限分类递归数组
    private function get_categorys_array($pid = 0)
    {
        $categorys= ArticleCategory::find()->indexBy('category_id')->asArray()->all();
        $ret = [];
        foreach($categorys as $key => $value){
            //对每个分类进行循环。 
            if($value['parent_id'] == $pid){ //如果有子类        
                $value['child'] = $this->get_categorys_array($key); //调用函数，传入参数，继续查询下级
                $ret[] = $value; //组合数组  
            }  
        }
        return $ret;
    }

    private function getCategoryTree($categorys,$info=[],$em=''){
        foreach ($categorys as $key => $value) {
            $value['em'] = $em;
            if($value['child']){
                if(strlen($em)>1){
                    $info[$value['category_id']]=$em.'|--'.$value['category_name'];   
                }else{
                    $info[$value['category_id']]=$value['category_name'];
                }
                $value['em'] .= "　　";
                $info = self::getCategoryTree($value['child'],$info,$value['em']);
            }else{
                if(strlen($em)>1){
                    $info[$value['category_id']]=$em.'|--'.$value['category_name'];   
                }else{
                    $info[$value['category_id']]=$value['category_name'];
                }
            }
            if($value['parent_id']==0){
                $em = '';
            }
        }

        return $info;
    }
}