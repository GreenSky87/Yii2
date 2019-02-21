<?php

/**
 * @var $day \app\models\Day
 */
use yii\bootstrap\ActiveForm;
?>
<div class="row">
    <div class="col-md-2">
        <h2>Создание новой даты</h2>
        <?php $form=ActiveForm::begin(
            ['action'=>'',
            'id'=>'day',
            'method'=>'POST']
        ); ?>
        <?php echo $form->field($day, 'date',   ['inputOptions' => 
                [
                    //'placeholder'=>'введите дату',
                    'type'=>'date']
            ] ); ?>
        <?php echo $form->field($day, 'weekend')->checkbox(); ?>
            <div class="form-group">
            <button type="submint" class="btb btn-default">Отправить</button>
            </div>
        <?php ActiveForm::end();?>
    </div>
</div>