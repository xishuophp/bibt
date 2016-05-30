<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article_term".
 *
 * @property string $term_id
 * @property string $term_name
 * @property string $slug
 * @property integer $parent
 * @property integer $article_count
 * @property integer $term_order
 * @property string $query_tag
 */
class ArticleTerm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_term';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['term_name', 'slug', 'query_tag'], 'required'],
            [['parent', 'article_count', 'term_order'], 'integer'],
            [['term_name', 'slug', 'query_tag'], 'string', 'max' => 100],
            [['query_tag'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'term_id' => Yii::t('app', 'Term ID'),
            'term_name' => Yii::t('app', 'Term Name'),
            'slug' => Yii::t('app', 'Slug'),
            'parent' => Yii::t('app', 'Parent'),
            'article_count' => Yii::t('app', 'Article Count'),
            'term_order' => Yii::t('app', 'Term Order'),
            'query_tag' => Yii::t('app', 'Query Tag'),
        ];
    }
}
