<?php

use app\modules\admin\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<?php


$this->registerJs(
    '$("document").ready(function(){
            $("#new_user").on("pjax:end", function() {
            $.pjax.reload({container:"#users"});  
        });
    });'
);
?>


<div class="user-form">
    <?php yii\widgets\Pjax::begin(['id' => 'new_user']) ?>

    <?php $form = ActiveForm::begin([  'action' => ['/admin/users/create'], 'options' => ['data-pjax' => true]]); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'newPasswordRepeat')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(User::getStatusesArray()) ?>

    <?= $form->field($model, 'role')->dropDownList(\yii\helpers\ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description')) ?>

    <div class="form-group">
        <?= Html::submitButton(
            $model->isNewRecord ? Yii::t('app', 'BUTTON_CREATE') : Yii::t('app', 'BUTTON_CREATE'),
            ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
        ) ?>
    </div>

    <?php ActiveForm::end(); ?>
    <?php yii\widgets\Pjax::end(); ?>
</div>