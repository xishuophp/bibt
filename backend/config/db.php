<?php

if(YII_ENV_PROD){
    $db = [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=bibt',
            'username' => 'root',
            'password' => 'gaeamobile123!@#',
            'charset' => 'utf8',
            //'enableSchemaCache' => true, 
            //'schemaCacheDuration' => 3600, 
            //'schemaCache' => 'cache', 
        ];
}else{
    $db = [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=192.168.22.249;dbname=bibt',
            'username' => 'root',
            'password' => 'GAEA123!@#',
            'charset' => 'utf8',
            //'enableSchemaCache' => true, 
            //'schemaCacheDuration' => 3600, 
            //'schemaCache' => 'cache',
        ];
}

return $db;