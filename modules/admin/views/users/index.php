<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\admin\models\User;
use app\modules\admin\components\UserStatusColumn;
use yii\helpers\ArrayHelper;
use app\modules\user\widgets\backend\grid\RoleColumn;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>




<?php
Modal::begin([
    'header' => '<h2>Hello world</h2>',
    'toggleButton' => [
        'label' => 'Добавить пользователя',
        'tag' => 'button',
        'class' => 'btn btn-success',
    ],
    'footer' => 'Низ окна',
]);
?>
<div class="user-create">
    <?php
    echo $this->render('_form_ajax', [
        'model' => $model,
    ]);
    ?>
</div>
<?php
Modal::end();
?>


<hr>


<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(['id' => 'users']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'created_at',
            'updated_at',
            'username',
            'auth_key',
            // 'email_confirm_token:email',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            [
                'class' => UserStatusColumn::className(),
                'filter' => User::getStatusesArray(),
                'attribute' => 'status',
            ],
            [
                'class' => RoleColumn::className(),
                'filter' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description'),
                'attribute' => 'role',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => ['style' => 'white-space: nowrap; text-align: center; letter-spacing: 0.1em; max-width: 7em;'],
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
