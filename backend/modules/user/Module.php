<?php

namespace backend\modules\user;

use Yii;

class Module extends \yii\base\Module
{
	public function init()
	{
		parent::init();

		// initialize the module with the configuration loaded from config.php
		\Yii::configure($this, require(__DIR__ . '/config/main.php'));

		$this->registerTranslations();

	}

	/**
	 * Add the translations for this module
	 */
	public function registerTranslations()
	{
		Yii::$app->i18n->translations['modules/user/*'] = [
			'class'          => 'yii\i18n\PhpMessageSource',
			'sourceLanguage' => 'en-US',
			'basePath'       => '@backend/modules/user/messages',
			'fileMap'        => [
				'modules/user/login'        => 'login.php',
				'modules/user/registration' => 'registration.php',
				'modules/user/reset'        => 'reset.php',
				'modules/user/role'         => 'role.php',
				'modules/user/user'         => 'user.php',
			],
		];
	}

	/**
	 * @param $category
	 * @param $message
	 * @param array $params
	 * @param null $language
	 * @return mixed
	 */
	public static function t($category, $message, $params = [], $language = null)
	{
		return Yii::t('modules/user/' . $category, $message, $params, $language);
	}

}