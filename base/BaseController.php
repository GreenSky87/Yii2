<?php
namespace app\base;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\HttpException;

class BaseController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if(\Yii::$app->user->isGuest){
            throw new HttpException(401,'Not access');
        }
        return parent::beforeAction($action);
    }    
    public function afterAction($action, $result)
    {
        $session= \Yii::$app->session;
        $session->setFlash('lastPage',\Yii::$app->request->absoluteUrl);
        return parent::afterAction($action, $result);
    }
}