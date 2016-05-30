<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "article".
 *
 * @property string $article_id
 * @property string $article_title
 * @property string $title_color
 * @property string $publish_date
 * @property string $article_excerpt
 * @property integer $article_status
 * @property string $article_author
 * @property string $article_content
 * @property string $article_alias
 * @property string $update_time
 * @property integer $article_category
 * @property integer $order_no
 * @property integer $hit_count
 * @property string $article_attachment
 * @property string $create_time
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_title', 'article_author', 'article_content', 'article_alias', 'create_time'], 'required'],
            [['article_title', 'article_excerpt', 'article_content', 'article_attachment'], 'string'],
            [['publish_date', 'update_time', 'create_time'], 'safe'],
            [['article_status', 'article_category', 'order_no', 'hit_count'], 'integer'],
            [['title_color', 'article_author'], 'string', 'max' => 50],
            [['article_alias'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'article_id' => Yii::t('app', 'Article ID'),
            'article_title' => Yii::t('app', 'Article Title'),
            'title_color' => Yii::t('app', 'Title Color'),
            'publish_date' => Yii::t('app', 'Publish Date'),
            'article_excerpt' => Yii::t('app', 'Article Excerpt'),
            'article_status' => Yii::t('app', 'Article Status'),
            'article_author' => Yii::t('app', 'Article Author'),
            'article_content' => Yii::t('app', 'Article Content'),
            'article_alias' => Yii::t('app', 'Article Alias'),
            'update_time' => Yii::t('app', 'Update Time'),
            'article_category' => Yii::t('app', 'Article Category'),
            'order_no' => Yii::t('app', 'Order No'),
            'hit_count' => Yii::t('app', 'Hit Count'),
            'article_attachment' => Yii::t('app', 'Article Attachment'),
            'create_time' => Yii::t('app', 'Create Time'),
        ];
    }
}
