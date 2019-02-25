<?php

namespace app\models;
use yii\base\Model;
use yii\web\UploadedFile;
use app\models\rules\CorrectTimeRule;
use app\models\rules\CorrectTimeStart;
use app\models\rules\DateTodayPlusRule;

class Activity extends Model
{
    public $title; 
    public $dateAct; 
    public $timeStart; 
    public $timeEnd; 
    public $use_notification;
    public $description;
    public $is_blocked; 
    public $is_repeated; 
    public $images; 
    public $imagesNewNames; 

    public function rules()
    {
        return [
            [['title', 'description', 'timeStart', 'timeEnd', 'dateAct'], 'required'],
            [['is_blocked', 'is_repeated', 'use_notification'], 'boolean'],
            [['images'], 'file', 'extensions' => 'jpg, png', 'maxFiles' => 4],
            ['dateAct', 'date', 'format' => 'php:d-m-Y'],
            ['timeStart', CorrectTimeStart::class], 
            ['timeEnd', CorrectTimeRule::class], 
            ['dateAct', DateTodayPlusRule::class], 
        ];
    }
    public function attributeLabels()
    {
        return [
            'title' => 'Название',
            'dateAct' => 'Дата',
            'timeStart' => 'Время начала',
            'timeEnd' => 'Время окончания',
            'use_notification' => 'Уведомление',
            'images' => 'Прикрепить файлы (макс. 4 шт.)',
            'description' => 'Описание',
            'is_blocked' => 'Блокирующее',
            'is_repeated' => 'Повторяющееся',
        ];
    }

}