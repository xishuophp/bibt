<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "article_category".
 *
 * @property string $category_id
 * @property string $category_name
 * @property integer $parent_id
 * @property integer $article_count
 * @property integer $order_no
 * @property string $query_tag
 */
class ArticleCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_name', 'query_tag'], 'required'],
            [['parent_id', 'article_count', 'order_no'], 'integer'],
            [['category_name', 'query_tag'], 'string', 'max' => 100],
            [['query_tag'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'category_id' => Yii::t('app', 'Category ID'),
            'category_name' => Yii::t('app', 'Category Name'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'article_count' => Yii::t('app', 'Article Count'),
            'order_no' => Yii::t('app', 'Order No'),
            'query_tag' => Yii::t('app', 'Query Tag'),
        ];
    }
}
