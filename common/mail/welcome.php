<?php
use frontend\modules\user\Module;

?>

<?= Module::t('signupForm', 'Welcome to {appName}, this are your login data', ['appName' => Yii::$app->params['appName']]); ?>
<ul style="list-style: none">
    <li><?= Module::t('signupForm', 'Username: {username}', ['username' => $model->username]); ?></li>
    <li><?= Module::t('signupForm', 'Password: {password}', ['password' => $model->password]); ?></li>
</ul>
<br/>