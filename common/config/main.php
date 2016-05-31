<?php
return [
//	'language'       => 'nl-NL',
	'sourceLanguage' => 'en-US',
	'vendorPath'     => dirname(dirname(__DIR__)) . '/vendor',
	'components'     => [
		'authManager' => [
			'class'        => 'yii\rbac\DbManager',
			'defaultRoles' => ['guest'],
		],
		'cache'       => [
			'class' => 'yii\caching\FileCache',
		],
		'formatter'   => [
			'nullDisplay'    => '',
			'currencyCode'   => 'EUR',
			'dateFormat'     => 'php:d-m-yy',
			'datetimeFormat' => 'php:d-m-yy H:i:s',
			'timeFormat'     => 'H:mm:ss',
			// 'booleanFormat'  => ['Nee', 'Ja'],
		],
		'i18n'        => [
			'translations' => [
				'*' => [
					'basePath'              => '@common/messages',
					'class'                 => 'yii\i18n\PhpMessageSource',
					'on missingTranslation' => ['common\components\i18n\TranslationEventHandler', 'handleMissingTranslation']
				],
			],
		],
		'urlManager'  => [
			'enablePrettyUrl' => true,
			'showScriptName'  => false,
		],
		'user'        => [
			'identityClass'   => 'common\models\User',
			'class'           => 'common\components\web\User',
			'enableAutoLogin' => true,
			'loginUrl'        => ['user/login'],
		],
	],
];
