<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use backend\models\Department;
use backend\models\YiiForum;

class ServiceDepartment extends Model
{
    /**
     * 查询某个部门的名称
     */
    public static function getDepartmentName($id){
        $department = Department::findOne($id);
        if($department){
            return $department->dept_name;
        }else{
            return '';
        }
    }

    public function getDepartmentList()
    {
        $departments = $this->get_departments_array();
        $ret = $this->getDeparmentTree($departments);
        return $ret;
    }
    //无限分类递归数组
    private function get_departments_array($pid = 0)
    {
        $departments= Department::find()->indexBy('dept_id')->asArray()->all();
        $ret = [];
        foreach($departments as $key => $value){
            //对每个分类进行循环。 
            if($value['parent_id'] == $pid){ //如果有子类        
                $value['child'] = $this->get_departments_array($key); //调用函数，传入参数，继续查询下级
                $ret[] = $value; //组合数组  
            }  
        }
        return $ret;
    }

    private function getDeparmentTree($departments,$info=[],$em=''){
        foreach ($departments as $key => $value) {
            $value['em'] = $em;
            if($value['child']){
                if(strlen($em)>1){
                    $info[$value['dept_id']]=$em.'|--'.$value['dept_name'];   
                }else{
                    $info[$value['dept_id']]=$value['dept_name'];
                }
                $value['em'] .= "　　";
                $info = self::getCategoryTree($value['child'],$info,$value['em']);
            }else{
                if(strlen($em)>1){
                    $info[$value['dept_id']]=$em.'|--'.$value['dept_name'];   
                }else{
                    $info[$value['dept_id']]=$value['dept_name'];
                }
            }
            if($value['parent_id']==0){
                $em = '';
            }
        }

        return $info;
    }
}