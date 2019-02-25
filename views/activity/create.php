<?php

/**
 * @var $activity \app\models\Activity
 */
use yii\bootstrap\ActiveForm;
?>
<div class="row">
    <div class="col=md-6">
        <h2>Создание новой активности</h2>
        <?php $form=ActiveForm::begin(
            ['action'=>'',
            'id'=>'activity',
            'method'=>'POST']
        ); ?>
        <?php echo $form->field($activity, 'title'); ?>
        <?php echo $form->field($activity, 'description')->textarea(['class'=>'custom form-control','data-att'=>'value']); ?>
        <?php echo $form->field($activity, 'is_blocked')->checkbox(); ?>
            <div class="form-group">
            <button type="submint" class="btb btn-default">Отправить</button>
            </div>
        <?php ActiveForm::end();?>
    </div>
</div>