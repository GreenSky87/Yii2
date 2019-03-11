<?php
namespace app\components;
use app\models\Activity;
use yii\base\Component;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;
class ActivityComponent extends Component
{
    public $activity_class;
    public function init()
	{
		parent::init();
		if(empty($this->activity_class)){
			throw new \Exception("Need attribute activity_class");
			
		}
	}
    public function getModel($params = null)
    {
        $model = new $this->activity_class;
        if ($params && is_array($params)) {
            $model->load($params);
        }
        return $model;
    }
    
    /**
     * @param $model Activity
     */
    public function createActivity(&$model)
    {
        if ($model->validate()) {
            $model->images = UploadedFile::getInstances($model, 'images');
            $path = $this->getPathSaveFile();
            foreach ($model->images as $image) {
                $name = mt_rand(0, 9999) . time() . '.' . $image->getExtension();
                if (!$image->saveAs($path . $name)) {
                    $model->addError('images', 'Файл не удалось переместить');
                    return false;
                }
                $model->imagesNewNames[] = $name;
            }
            return true;
        }
    }
    /**
     * @param $model Activity
     * @return bool
     */
    public function updateActivity(&$model)
    {
        if ($model->validate()) {
            $model->update();
            return true;
        } else {
//            print_r($model->errors);
            return false;
        }
    }
    public function deleteActivity($id)
    {
        if ($this->getActivity($id)->delete()) {
            return true;
        } else {
            print_r("Ошибка при удалении");
            return false;
        }
    }
    
    private function getPathSaveFile()
    {
        return \Yii::getAlias('@app/web/images/');
    }
    /**
     * @param $params
     * @return \yii\data\ActiveDataProvider
     */
    public function getSearchProvider($params)
    {
        $model = new ActivitySearch();
        return $model->getDataProvider();
    }
    /**
     * @param $id
     * @return Activity|array|\yii\db\ActiveRecord|null
     */
	public function getActivity($id){
	    return $this->getModel()::find()->andWhere(['id'=>$id])->one();
    }
    private function saveImages(&$model){
        $path = $this->getPathSaveFile();
        if($model->images) {
            foreach ($model->images as $image) {
                $name = mt_rand(0, 9999) . time() . '.' . $image->getExtension();
                if (!$image->saveAs($path . $name)) {
                    $model->addError('images', 'Файл не удалось переместить');
                    return false;
                }
                $model->imagesNewNames[] = $name;
            }
        }else{
            return true;
        }
    }
}