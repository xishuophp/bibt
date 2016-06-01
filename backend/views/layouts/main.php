<?php
use backend\assets\AppAsset;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Request;
use common\base\AuthManager;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <?= Html::csrfMetaTags() ?>
    <script type="text/javascript">
        //获取浏览器页面可见高度和宽度
        var _PageHeight = document.documentElement.clientHeight,
            _PageWidth = document.documentElement.clientWidth;
        //计算loading框距离顶部和左部的距离（loading框的宽度为215px，高度为61px）
        var _LoadingTop = _PageHeight > 61 ? (_PageHeight - 61) / 2 : 0,
            _LoadingLeft = _PageWidth > 215 ? (_PageWidth - 215) / 2 : 0;
        //在页面未加载完毕之前显示的loading Html自定义内容
         var _LoadingHtml = '<div id="loadingDiv" style="position:absolute;left:0;width:100%;height:' + _PageHeight + 'px;top:0;background:#f3f8ff;opacity:0.8;filter:alpha(opacity=80);z-index:10000;"><div style="position: absolute; cursor1: wait; left: ' + _LoadingLeft + 'px; top:' + _LoadingTop + 'px; width: 200px; height: 80px; line-height: 80px; padding-left: 20px; padding-right: 20px; background: #fff url(/static/images/134.GIF) no-repeat scroll 20px 10px; border: 2px solid #95B8E7; color: #696969; font-family:\'Microsoft YaHei\';">页面加载中，请等待...</div></div>';
        //呈现loading效果
        document.write(_LoadingHtml);
        //监听加载状态改变
        document.onreadystatechange = completeLoading;
        //加载状态为complete时移除loading效果
        function completeLoading() {
            if (document.readyState == "complete") {
                var loadingMask = document.getElementById('loadingDiv');
                loadingMask.parentNode.removeChild(loadingMask);
            }
        }
    </script>
    <!--[if lte IE 9]>
        <link rel="stylesheet" href="/static/css/ace-part2.min.css" />
    <![endif]-->
    <!--[if lte IE 9]>
      <link rel="stylesheet" href="/static/css/ace-ie.min.css" />
    <![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="/static/js/html5shiv.js"></script>
    <script src="/static/js/respond.min.js"></script>
    <![endif]-->
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

    <body class="no-skin">
        <?php $this->beginBody() ?>
        <!-- #section:basics/navbar.layout -->
        <div id="navbar" class="navbar navbar-default">
            <script type="text/javascript">
                try{ace.settings.check('navbar' , 'fixed')}catch(e){}
            </script>

            <div class="navbar-container" id="navbar-container">
                <!-- #section:basics/sidebar.mobile.toggle -->
                <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler">
                    <span class="sr-only">Toggle sidebar</span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>

                    <span class="icon-bar"></span>
                </button>

                <!-- /section:basics/sidebar.mobile.toggle -->
                <div class="navbar-header pull-left">
                    <!-- #section:basics/navbar.layout.brand -->
                    <a href="#" class="navbar-brand">
                        <small>
                            管理平台
                        </small>
                    </a>

                    <!-- /section:basics/navbar.layout.brand -->

                    <!-- #section:basics/navbar.toggle -->

                    <!-- /section:basics/navbar.toggle -->
                </div>

                <!-- #section:basics/navbar.dropdown -->
                <div class="navbar-buttons navbar-header pull-right" role="navigation">
                    <ul class="nav ace-nav">
                        <li class="light-blue">
                                <?php
                                    $languageArr = [
                                        'zh-CN' =>\Yii::t('app' , 'Chinese'),
                                        'en' => \Yii::t('app' ,'English'),
                                        //'jp' => 'Japan',
                                        //'kr' => 'Korea',
                                    ];
                                    $language = Yii::$app->session['language'];
                                    if(!isset($languageArr[$language])){
                                        $language = 'zh-CN';
                                    }

                                ?>
                                <a style="width:90px;" href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                                <i class="fa fa-language" aria-hidden="true"></i>

                                <span class="username"><?= Yii::t('app', $languageArr[$language]) ?></span>
                                
                                </a>
                                <ul class="dropdown-menu">
                                        <?php
                                            unset($languageArr[$language]);
                                            foreach($languageArr as $lang=>$langInfo){
                                                echo "<li><a href=\"".Yii::$app->urlManager->createUrl(['welcome/language','lang'=>Yii::t('app',$lang)])."\"> ".Yii::t('app',$langInfo)." </a></li>\n";
                                            }
                                        ?>
                                </ul>
                        </li>
                        <!-- #section:basics/navbar.user_menu -->
                        <li class="light-blue">
                            <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                            <?php
                            $user_img = json_decode(Yii::$app->user->identity->avatar,true);
                            $sex = Yii::$app->user->identity->sex;
                            if(!empty($user_img)){
                                echo '<img class="nav-user-photo" src="'.$user_img[0]['fileUrl'].'" alt="" />';
                            }else{
                                if($sex==1){
                                    echo '<img class="nav-user-photo" src="/static/avatars/avatar4.png" alt="" />';
                                }else{
                                    echo '<img class="nav-user-photo" src="/static/avatars/avatar3.png" alt="" />';
                                }
                            }
                            
                            ?>
                                
                                <span class="user-info">
                                    <small>Welcome,</small>
                                    <?=Yii::$app->user->identity->nickname?>
                                </span>

                                <i class="ace-icon fa fa-caret-down"></i>
                            </a>

                            <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close" style="min-width:100px">
                                <!--<li>
                                    <a href="#">
                                        <i class="ace-icon fa fa-cog"></i>
                                        Settings
                                    </a>
                                </li>-->

                                <li>
                                    <a href="<?php echo Yii::$app->urlManager->createUrl('site/logout');?>">
                                        <i class="ace-icon fa fa-power-off"></i>
                                         <?=Yii::t('app','Logout')?>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- /section:basics/navbar.user_menu -->
                    </ul>
                </div>

                <!-- /section:basics/navbar.dropdown -->
            </div><!-- /.navbar-container -->
        </div>

        <!-- /section:basics/navbar.layout -->
        <div class="main-container" id="main-container">
            <script type="text/javascript">
                try{ace.settings.check('main-container' , 'fixed')}catch(e){}
            </script>

            <!-- #section:basics/sidebar -->
            <div id="sidebar" class="sidebar responsive">
                <script type="text/javascript">
                    try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
                </script>
                    <?php
                        $leftNav = [
                            // 'task' => ['task_create','task_my-task'],
                            'user' => ['user_list','user_info','user_update-password'],
                            'department' => ['department_list','department_create'],
                            'article' => ['article_list','article_create','article_category-list','article_category-create'],
                            'nav' => ['nav_list','nav_create'],
                            'staff' => ['staff_list','staff_create'],
                            'apply-online' => ['apply-online_list'],
                            'admission' => ['admission_list','admission_create'],
                            'conf' => ['conf_index'],
                            'auth' => [
                                'role' => ['role_user-index','role_index','role_create'],
                                'permission' => ['permission_index','permission_create'],
                            ],
                        ];

                        if(!in_array(Yii::$app->user->identity->username,Yii::$app->params['systemAdmin'])) {
                            $AuthManagerModel = new AuthManager();
                            $userid = Yii::$app->user->identity->id;
                            foreach($leftNav as $k=>&$node){
                                if(is_array($node)){
                                    foreach($node as $k2=>&$node2){
                                        if(is_array($node2)){
                                            foreach($node2 as $k3=>&$node3){
                                                $check = $AuthManagerModel->checkAccess($userid,$node3);
                                                if(!$check&&YII_ENV_PROD)//YII_ENV_PROD
                                                    unset($node2[$k3]);
                                            }
                                            
                                        }else{
                                            $check = $AuthManagerModel->checkAccess($userid,$node2);
                                            if(!$check&&YII_ENV_PROD)
                                                unset($node[$k2]);
                                        }
                                        
                                    }
                                }else{
                                    $check = $AuthManagerModel->checkAccess($userid,$node);
                                    if(!$check)
                                        unset($node[$k]);
                                }
                            }
                        }
                        
                    ?>

                <ul class="nav nav-list">   
                    <?php
                        $route = strtolower(Yii::$app->controller->route);
                        $routeArr = explode('/',$route);
                    ?>
                    <li class="<?php if(strtolower($routeArr[0]) == 'welcome') echo 'active';?>">
                        <a href="/">
                            <i class="menu-icon fa fa-tachometer"></i>
                            <span class="menu-text"><?=Yii::t('app','Home')?></span>
                        </a>

                        <b class="arrow"></b>
                    </li>
                    <?php if(!empty($leftNav['user'])):?>
                    <li class="<?php if(strtolower($routeArr[0]) == 'user') echo 'active open' ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-users"></i>
                            <span class="menu-text"><?=Yii::t('app','User Manage')?></span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <?php if(in_array('user_list',$leftNav['user'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'user' && (in_array(strtolower($routeArr[1]),['list','create','update']))) echo 'active' ?>">
                                <a href="<?= Url::to(['user/list'])?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <?=Yii::t('app','User List')?>
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <?php endif;?>
                            <?php if(in_array('user_info',$leftNav['user'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'user' && strtolower($routeArr[1]) == 'info') echo 'active' ?>">
                                <a href="<?= Url::to(['user/info'])?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <?=Yii::t('app','User Info')?>
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <?php endif;?>
                            <?php if(in_array('user_update-password',$leftNav['user'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'user' && strtolower($routeArr[1]) == 'update-password') echo 'active' ?>">
                                <a href="<?= Url::to(['user/update-password'])?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <?=Yii::t('app','Update Password')?>
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <?php endif;?>                    
                        </ul>
                    </li>
                    <?php endif;?>
                    <?php if(!empty($leftNav['department'])):?>
                    <li class="<?php if(strtolower($routeArr[0]) == 'department') echo 'active open' ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-pencil-square-o"></i>
                            <span class="menu-text"><?=Yii::t('app','Dept Manage')?></span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <?php if(in_array('department_list',$leftNav['department'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'department' && (in_array(strtolower($routeArr[1]),['list','update','view']))) echo 'active' ?>">
                                <a href="<?= Url::to(['department/list'])?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <?=Yii::t('app','Dept List')?>
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <?php endif;?>
                            <?php if(in_array('department_create',$leftNav['department'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'department' && strtolower($routeArr[1]) == 'create') echo 'active' ?>">
                                <a href="<?= Url::to(['department/create'])?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <?=Yii::t('app','Create Dept')?>
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <?php endif;?>                  
                        </ul>
                    </li>
                    <?php endif;?>
                    <?php if(!empty($leftNav['article'])):?>
                    <li class="<?php if(strtolower($routeArr[0]) == 'article') echo 'active open' ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-pencil-square-o"></i>
                            <span class="menu-text"><?=Yii::t('app','Article Manage')?></span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <?php if(in_array('article_list',$leftNav['article'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'article' && (in_array(strtolower($routeArr[1]),['list','update','view']))) echo 'active' ?>">
                                <a href="<?= Url::to(['article/list'])?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <?=Yii::t('app','Article List')?>
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <?php endif;?>
                            <?php if(in_array('article_create',$leftNav['article'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'article' && strtolower($routeArr[1]) == 'create') echo 'active' ?>">
                                <a href="<?= Url::to(['article/create'])?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <?=Yii::t('app','Publish Article')?>
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <?php endif;?>
                            <?php if(in_array('article_category-list',$leftNav['article'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'article' && strtolower($routeArr[1]) == 'category-list,category-update') echo 'active' ?>">
                                <a href="<?= Url::to(['article/category-list'])?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <?=Yii::t('app','Category List')?>
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <?php endif;?>
                            <?php if(in_array('article_category-create',$leftNav['article'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'article' && strtolower($routeArr[1]) == 'category-create') echo 'active' ?>">
                                <a href="<?= Url::to(['article/category-create'])?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <?=Yii::t('app','Create Category')?>
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <?php endif;?>                  
                        </ul>
                    </li>
                    <?php endif;?>
                    <?php if(!empty($leftNav['nav'])):?>
                    <li class="<?php if(strtolower($routeArr[0]) == 'nav') echo 'active open' ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-pencil-square-o"></i>
                            <span class="menu-text"><?=Yii::t('app','Nav Manage')?></span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <?php if(in_array('nav_list',$leftNav['nav'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'nav' && (in_array(strtolower($routeArr[1]),['list','update','view']))) echo 'active' ?>">
                                <a href="<?= Url::to(['nav/list'])?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <?=Yii::t('app','Nav List')?>
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <?php endif;?>
                            <?php if(in_array('nav_create',$leftNav['nav'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'nav' && strtolower($routeArr[1]) == 'create') echo 'active' ?>">
                                <a href="<?= Url::to(['nav/create'])?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <?=Yii::t('app','Create Nav')?>
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <?php endif;?>                  
                        </ul>
                    </li>
                    <?php endif;?>
                    <?php if(!empty($leftNav['staff'])):?>
                    <li class="<?php if(strtolower($routeArr[0]) == 'staff') echo 'active open' ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon glyphicon glyphicon-user"></i>
                            <span class="menu-text"><?=Yii::t('app','Staff Manage')?></span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <?php if(in_array('staff_list',$leftNav['staff'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'staff' && (in_array(strtolower($routeArr[1]),['list','update','view']))) echo 'active' ?>">
                                <a href="<?= Url::to(['staff/list'])?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <?=Yii::t('app','Staff List')?>
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <?php endif;?>
                            <?php if(in_array('staff_create',$leftNav['staff'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'staff' && strtolower($routeArr[1]) == 'create') echo 'active' ?>">
                                <a href="<?= Url::to(['staff/create'])?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <?=Yii::t('app','Create Staff')?>
                                </a>

                                <b class="arrow"></b>
                            </li>
                            <?php endif;?>                  
                        </ul>
                    </li>
                    <?php endif;?>
                    <?php if(!empty($leftNav['apply-online'])):?>
                    <li class="<?php if(strtolower($routeArr[0]) == 'apply-online') echo 'active open' ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-pencil-square-o"></i>
                            <span class="menu-text"><?=Yii::t('app','Apply Manage')?></span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <?php if(in_array('apply-online_list',$leftNav['apply-online'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'apply-online' && (in_array(strtolower($routeArr[1]),['list','view']))) echo 'active' ?>">
                                <a href="<?= Url::to(['apply-online/list'])?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <?=Yii::t('app','Apply List')?>
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <?php endif;?>                 
                        </ul>
                    </li>
                    <?php endif;?>
                    <?php if(!empty($leftNav['admission'])):?>
                    <li class="<?php if(strtolower($routeArr[0]) == 'admission') echo 'active open' ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-pencil-square-o"></i>
                            <span class="menu-text"><?=Yii::t('app','Admission Manage')?></span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <?php if(in_array('admission_list',$leftNav['admission'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'admission' && (in_array(strtolower($routeArr[1]),['list','update']))) echo 'active' ?>">
                                <a href="<?= Url::to(['admission/list'])?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <?=Yii::t('app','Admission List')?>
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <?php endif;?>
                            <?php if(in_array('admission_create',$leftNav['admission'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'admission' && strtolower($routeArr[1])=='create') echo 'active' ?>">
                                <a href="<?= Url::to(['admission/create'])?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <?=Yii::t('app','Create Admission')?>
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <?php endif;?>                 
                        </ul>
                    </li>
                    <?php endif;?>
                    <?php if(!empty($leftNav['conf'])):?>
                    <li class="<?php if(strtolower($routeArr[0]) == 'conf') echo 'active open' ?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-cogs"></i>
                            <span class="menu-text"><?=Yii::t('app','Conf Manage')?></span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <?php if(in_array('conf_index',$leftNav['conf'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'conf' && strtolower($routeArr[1])=='index') echo 'active' ?>">
                                <a href="<?= Url::to(['conf/index'])?>">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    <?=Yii::t('app','Conf List')?>
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <?php endif;?>                 
                        </ul>
                    </li>
                    <?php endif;?>
                    <?php if(!empty($leftNav['auth']) && (!empty($leftNav['auth']['role']) || !empty($leftNav['auth']['permission']))):?>
                    <li class="<?php if(strtolower($routeArr[0]) == 'role' || strtolower($routeArr[0]) == 'permission' || strtolower($routeArr[0] == 'nav-node')) echo 'active open';?>">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-list"></i>
                            <span class="menu-text"> <?=Yii::t('app','Auth Manage');?></span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">
                            <?php if(!empty($leftNav['auth']['role'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'role') echo 'active open';?>">
                                <a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                        <?=Yii::t('app','Role Manage')?>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>

                                <b class="arrow"></b>

                                <ul class="submenu">
                                    <?php if(in_array('role_user-index',$leftNav['auth']['role'])):?>
                                    <li class="<?php if(strtolower($routeArr[0] == 'role') && (strtolower($routeArr[1]) == 'user-index' || strtolower($routeArr[1]) == 'set-user')) echo 'active' ?>">
                                        <a href="<?= Url::to(['role/user-index'])?>">
                                            <i class="menu-icon fa fa-leaf"></i>
                                            <?=Yii::t('app','User List')?>
                                        </a>

                                        <b class="arrow"></b>
                                    </li>
                                    <?php endif;?>
                                    <?php if(in_array('role_index',$leftNav['auth']['role'])):?>
                                    <li class="<?php if(strtolower($routeArr[0] == 'role') && strtolower($routeArr[1]) == 'index') echo 'active' ?>">
                                        <a href="<?= Url::to(['role/index'])?>">
                                            <i class="menu-icon fa fa-leaf"></i>
                                            <?=Yii::t('app','Role List')?>
                                        </a>

                                        <b class="arrow"></b>
                                    </li>
                                    <?php endif;?>
                                    <?php if(in_array('role_create',$leftNav['auth']['role'])):?>
                                    <li class="<?php if(strtolower($routeArr[0] == 'role') && strtolower($routeArr[1]) == 'create') echo 'active' ?>">
                                        <a href="<?= Url::to(['role/create'])?>">
                                            <i class="menu-icon fa fa-leaf"></i>
                                            <?=Yii::t('app','Create Role')?>
                                        </a>

                                        <b class="arrow"></b>
                                    </li>
                                    <?php endif;?>
                                </ul>
                            </li>
                            <?php endif;?>
                            <?php if(!empty($leftNav['auth']['permission'])):?>
                            <li class="<?php if(strtolower($routeArr[0]) == 'permission') echo 'active open';?>">
                                <a href="#" class="dropdown-toggle">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                        <?=Yii::t('app','Permission Manage')?>
                                    <b class="arrow fa fa-angle-down"></b>
                                </a>

                                <b class="arrow"></b>

                                <ul class="submenu">
                                    <?php if(in_array('permission_index',$leftNav['auth']['permission'])):?>
                                    <li class="<?php if(strtolower($routeArr[0]) == 'permission' && strtolower($routeArr[1]) == 'index') echo 'active' ?>">
                                        <a href="<?= Url::to(['permission/index'])?>">
                                            <i class="menu-icon fa fa-leaf"></i>
                                            <?=Yii::t('app','Permission List')?>
                                        </a>

                                        <b class="arrow"></b>
                                    </li>
                                    <?php endif;?>
                                    <?php if(in_array('permission_create',$leftNav['auth']['permission'])):?>
                                    <li class="<?php if(strtolower($routeArr[0]) == 'permission' && strtolower($routeArr[1]) == 'create') echo 'active' ?>">
                                        <a href="<?= Url::to(['permission/create'])?>">
                                            <i class="menu-icon fa fa-leaf"></i>
                                            <?=Yii::t('app','Create Permission')?>
                                        </a>

                                        <b class="arrow"></b>
                                    </li>
                                    <?php endif;?>
                                </ul>
                            </li>
                            <?php endif;?>
                        </ul>
                    </li>
                    <?php endif;?>

                </ul><!-- /.nav-list -->

                <!-- #section:basics/sidebar.layout.minimize -->
                <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
                    <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
                </div>

                <!-- /section:basics/sidebar.layout.minimize -->
                <script type="text/javascript">
                    try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
                </script>
            </div>
            <!-- /section:basics/sidebar -->
            <div class="main-content">

                <!-- #section:basics/content.breadcrumbs -->
                <div class="breadcrumbs" id="breadcrumbs">

                    <script type="text/javascript">
                        try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
                    </script>
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>

                </div>

            <?=$content;?>
            </div>
            <!-- /.main-content -->

            <div class="footer">
                <div class="footer-inner">
                    <!-- #section:basics/footer -->
                    <div class="footer-content">
                        <span class="bigger-120">
                            <span class="blue bolder">CMS</span>
                             &copy; 2014-<?=date('Y')?>
                        </span>
                        <!--<span class="action-buttons">
                            <a href="#">
                                <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                            </a>

                            <a href="#">
                                <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                            </a>

                            <a href="#">
                                <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                            </a>
                        </span>-->
                    </div>

                    <!-- /section:basics/footer -->
                </div>
            </div>

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        <!-- basic scripts -->
        <!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='/static/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
        <script type="text/javascript">
            window.jQuery || document.write("<script src='/static/js/jquery.min.js'>"+"<"+"/script>");
        </script>
        <script type="text/javascript">
            if('ontouchstart' in document.documentElement) document.write("<script src='/static/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
        </script>
        
    <?php $this->endBody() ?>
    </body>
</html>
<script type="text/javascript">
    var spin_length = 28;
    var spin_radius = 42;
    var body_width =  (window.innerWidth)/2-(spin_length+spin_radius);
    var body_height = (window.innerHeight)/2-(spin_length+spin_radius);
    var opts = {
        lines: 13 // The number of lines to draw
        , length: spin_length // The length of each line
        , width: 14 // The line thickness
        , radius: spin_radius // The radius of the inner circle
        , scale: 1 // Scales overall size of the spinner
        , corners: 1 // Corner roundness (0..1)
        , color: "#000" // #rgb or #rrggbb or array of colors
        , opacity: 0.25 // Opacity of the lines
        , rotate: 0 // The rotation offset
        , direction: 1 // 1: clockwise, -1: counterclockwise
        , speed: 1 // Rounds per second
        , trail: 60 // Afterglow percentage
        , fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
        , zIndex: 2e9 // The z-index (defaults to 2000000000)
        , className: "spinner" // The CSS class to assign to the spinner
        , top: body_height // Top position relative to parent
        , left: body_width // Left position relative to parent
        , shadow: false // Whether to render a shadow
        , hwaccel: false // Whether to use hardware acceleration
        , position: "relative" // Element positioning
    };
    var spinner = new Spinner(opts);
</script>
<?php $this->beginBlock('cms') ?>
    $(document).ready(function () {
        $('#modal-form').on('shown.bs.modal', function () {
            $(this).find('.chosen-container').each(function(){
                $(this).find('a:first-child').css('width' , '210px');
                $(this).find('.chosen-drop').css('width' , '210px');
                $(this).find('.chosen-search input').css('width' , '200px');
            });
        });
    });  
<?php $this->endBlock() ?>
<?php $this->registerJs($this->blocks['cms'], \yii\web\View::POS_END); ?>
<?php $this->endPage() ?>