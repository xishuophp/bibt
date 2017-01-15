<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property string $course_id
 * @property string $academic_year
 * @property string $class_room
 * @property string $class_grade
 * @property string $class_name
 * @property string $course_name
 * @property string $teacher
 * @property string $week_day
 * @property string $class_time
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
            [['class_name', 'course_name', 'teacher', 'class_time', 'section'], 'required'],
            [['note'], 'string'],
            [['academic_year', 'class_room', 'class_grade', 'class_name', 'course_name', 'teacher', 'week_day', 'class_time'], 'string', 'max' => 255],
            [['section'], 'string', 'max' => 100],
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
            'class_grade' => Yii::t('app', 'Class Grade'),
            'class_name' => Yii::t('app', 'Class Name'),
            'course_name' => Yii::t('app', 'Course Name'),
            'teacher' => Yii::t('app', 'Teacher'),
            'week_day' => Yii::t('app', 'Week Day'),
            'class_time' => Yii::t('app', 'Class Time'),
            'section' => Yii::t('app', 'Section'),
            'note' => Yii::t('app', 'Note'),
        ];
    }
}
