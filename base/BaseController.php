<?php
namespace app\base;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class BaseController extends Controller
{
        //Yii::$app->getSession()->setFlash('userPage', '127.0.0.1' . $_SERVER['REQUEST_URI']);
    public function afterAction($action, $result)
    {
        \Yii::$app->session->setFlash('userPage',\Yii::$app->request->url);
        return parent::afterAction($action, $result);
    }
}