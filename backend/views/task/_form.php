<?php

use common\models\enum\TaskStatus;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\TaskForm $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="task-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dueDate')->widget(\yii\jui\DatePicker::class,
        [
            'dateFormat' => 'php:d-m-Y',
            'options' => ['class' => 'form-control'],
            'clientOptions' => [
                'changeYear' => true,
                'changeMonth' => true,
                'minDate' => '+1d',
                'altFormat' => 'dd-mm-yy',
            ]
        ])
        ->textInput(['placeholder' => 'dd-mm-yyyy']);
    ?>

    <?= $form->field($model, 'status')->dropDownList([TaskStatus::Active->value => TaskStatus::Active->name]) ?>

    <?= $form->field($model, 'priority')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
