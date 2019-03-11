<?php
namespace app\controllers\actions;
use app\components\ActivityComponent;
use app\components\DaoComponent;
use app\models\Activity;
use yii\base\Action;
use yii\web\HttpException;
class ActivityEditAction extends Action
{
    public function run($id)
    {
        /** @var ActivityComponent $comp */
        $comp = \Yii::$app->activity;
        // получить id события из адресной строки
//        $id = \Yii::$app->request->get('id');
        if (!isset($id)) {
            throw new HttpException(400, 'Не указан id активности');
        }
        // получить запись (ActiveRecord) события
        $activity = $comp->getActivity($id);
        if (!$activity) {
            throw new HttpException(400, 'Активности с таким id не существует');
        }
        // проверка, что пользователь не является создателем активности (может его просматривать) и админом
        if (!\Yii::$app->rbac->canViewActivity($activity) && !\Yii::$app->rbac->canViewEditAll()) {
//        if (!\Yii::$app->rbac->canViewEditAll()) {
//            return $this->controller->redirect(['/auth/sign-in']);
            throw new HttpException(403, 'У вас нет прав на редактирование этой активности');
        }
        // если пришел post-запрос
        if (\Yii::$app->request->isPost) {
            // загрузить post-данные в запись события
            $activity->load(\Yii::$app->request->post());
            if ($comp->updateActivity($activity)) { // если удалось сделать update, перейти на страницу подтверждения
                if (\Yii::$app->rbac->canViewEditAll()) {
                    return $this->controller->redirect(['/admin/activities']);
                } else {
                    return $this->controller->render('create-confirm',
                        ['activity' => $activity,]);
                }
            }
        }
        return $this->controller->render('edit', ['activity' => $activity]);
    }

}