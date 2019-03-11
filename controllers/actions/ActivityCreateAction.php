<?php
namespace app\controllers\actions;
use app\components\ActivityComponent;
use app\models\Activity;
use yii\base\Action;
use yii\web\HttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
// работа с событием через ActiveRecord
class ActivityCreateAction extends Action
{
    public function run()
    {
        if(!\Yii::$app->rbac->canCreateActivity()){
//        if (!\Yii::$app->rbac->canViewEditAll()) {
            return $this->controller->redirect(['/auth/sign-in']);
//            throw new HttpException(403, 'Нет доступа к созданию');
        }
        /** @var ActivityComponent $comp */
        $comp = \Yii::$app->activity;
        /** @var Activity $model */
        $activity = $comp->getModel(\Yii::$app->request->post());
//        $activity->user_id = \Yii::$app->user->id; // записать в модель Активности id текущего залогиненного пользователя
        if(\Yii::$app->request->isPost){
            if($comp->createActivity($activity)){
                \Yii::$app->session->addFlash('success', 'Создано новое событие');
                return $this->controller->render('create-confirm', ['activity' => $activity]);
            }
        }
        else {
            $activity = $comp->getModel();
        }
        return $this->controller->render('create', ['activity' => $activity]);
    }
}