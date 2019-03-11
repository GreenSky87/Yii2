<?php
namespace app\controllers;

use app\base\BaseController;
use app\controllers\actions\ActivityCreateAction;
use app\controllers\actions\ActivityEditAction;
use app\models\Activity;
use yii\web\Controller;


class ActivityController extends BaseController
{
    public function actions(){
        return [
            'create' => [
                'class' => ActivityCreateAction::class
            ],
            'edit' => [
                'class' => ActivityEditAction::class
            ],
            'delete' => [
                'class' => ActivityDeleteAction::class,
            ],
        ];
    }
}