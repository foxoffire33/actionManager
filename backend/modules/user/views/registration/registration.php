<?php
use backend\modules\user\Module;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\modules\user\models\forms\RegistrationForm */
?>

<?php
$this->title = Module::t('registration', 'Register');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="user-registration content">
	<?php $form = ActiveForm::begin(['id' => 'registration-form']); ?>

	<h2><?= Module::t('registration', 'You can register here') ?></h2>
	<?= $form->field($model, 'username', ['inputOptions' => ['placeholder' => Module::t('registration', 'Username')]])->label(false) ?>
	<?= $form->field($model, 'email', ['inputOptions' => ['placeholder' => Module::t('registration', 'Email')]])->label(false) ?>
	<div class="row">
		<div class="col-md-6">
			<?= $form->field($model, 'password', ['inputOptions' => ['placeholder' => Module::t('registration', 'Password')]])->passwordInput()->label(false) ?>
		</div>
		<div class="col-md-6">
			<?= $form->field($model, 'repeat_password', ['inputOptions' => ['placeholder' => Module::t('registration', 'Repeat Password')]])->passwordInput()->label(false) ?>
		</div>
	</div>
	<div class="form-group">
		<?= Html::submitButton(Module::t('registration', 'Register'), ['class' => 'btn btn-success', 'name' => 'register-button']) ?>
	</div>

	<?php ActiveForm::end(); ?>
</div>
