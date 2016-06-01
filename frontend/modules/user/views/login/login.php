<?php
use backend\modules\user\Module;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\modules\user\models\forms\LoginForm */
?>

<?php
$this->title = Module::t('login', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="user-login">
	<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
	<h2>Meld je aan</h2>
	<?= $form->field($model, 'username', ['inputOptions' => ['placeholder' => Module::t('login', 'Username')]])->label(false) ?>
	<?= $form->field($model, 'password', ['inputOptions' => ['placeholder' => Module::t('login', 'Password')]])->passwordInput()->label(false) ?>
	<!--<?= $form->field($model, 'rememberMe')->checkbox() ?>-->
	<div class="form-group">
		<?= Html::submitButton('Login', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
	</div>
	<hr/>
	<span>
		<?= Module::t('registration', 'Click {registration_link} to register if you do not have an account', ['registration_link' => Html::a(Module::t('registration', 'here'), ['/user/registration'], ['class' => 'registration-link'])]) ?>
	</span>
	<hr/>
	<span>
		<?= Module::t('reset', '{reset_link}', ['reset_link' => Html::a(Module::t('reset', 'reset'), ['/user/reset'], ['class' => 'reset-link'])]) ?>
	</span>
	<?php ActiveForm::end(); ?>
</div>
