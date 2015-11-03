<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publication".
 *
 * @property integer $id
 * @property string $url
 * @property string $title
 * @property string $kind
 * @property string $isbn
 * @property string $volume
 * @property integer $year
 * @property string $tags
 * @property string $description
 * @property string $content
 * @property string $publication_date
 */
class Publication extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publication';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'content', 'publication_date'], 'required'],
            [['year'], 'integer'],
            [['content'], 'string'],
            [['publication_date'], 'safe'],
            [['url', 'title', 'kind', 'isbn', 'volume', 'tags', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'url' => Yii::t('app', 'Url'),
            'title' => Yii::t('app', 'Title'),
            'kind' => Yii::t('app', 'Kind'),
            'isbn' => Yii::t('app', 'Isbn'),
            'volume' => Yii::t('app', 'Volume'),
            'year' => Yii::t('app', 'Year'),
            'tags' => Yii::t('app', 'Tags'),
            'description' => Yii::t('app', 'Description'),
            'content' => Yii::t('app', 'Content'),
            'publication_date' => Yii::t('app', 'Publication Date'),
        ];
    }
}
