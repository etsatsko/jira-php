<?php use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['id' => 'add-task-form']); ?>

<?= $form->field($model, 'title')->textInput(['autofocus' => true]) ?>

<?= $form->field($model, 'type')->dropDownList(
    ArrayHelper::map($types, 'id', 'name')
) ?>

<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'executor')->dropDownList(
    ArrayHelper::map($users, 'id', 'login')
) ?>
<?= $form->field($model, 'status')->dropDownList(
    ArrayHelper::map($statuses, 'id', 'name')
) ?>
<?= $form->field($model, 'serviceClass')->dropDownList(
    ArrayHelper::map($serviceClasses, 'id', 'name')
) ?>
<?= $form->field($model, 'deadline')->textInput(['type' => 'date']) ?>

<?= $form->field($model, 'timeEstimate')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-primary', 'name' => 'add-button']) ?>
    </div>

<?php ActiveForm::end(); ?>