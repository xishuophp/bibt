<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property string $course_id
 * @property integer $academic_year
 * @property string $class_room
 * @property string $class_name
 * @property string $course_name
 * @property string $teacher
 * @property integer $week_day
 * @property string $section
 * @property string $note
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['academic_year', 'week_day'], 'integer'],
            [['class_name', 'course_name', 'teacher', 'week_day', 'section'], 'required'],
            [['note'], 'string'],
            [['class_room', 'course_name', 'section'], 'string', 'max' => 100],
            [['class_name'], 'string', 'max' => 255],
            [['teacher'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'course_id' => Yii::t('app', 'Course ID'),
            'academic_year' => Yii::t('app', 'Academic Year'),
            'class_room' => Yii::t('app', 'Class Room'),
            'class_name' => Yii::t('app', 'Class Name'),
            'course_name' => Yii::t('app', 'Course Name'),
            'teacher' => Yii::t('app', 'Teacher'),
            'week_day' => Yii::t('app', 'Week Day'),
            'section' => Yii::t('app', 'Section'),
            'note' => Yii::t('app', 'Note'),
        ];
    }
}
