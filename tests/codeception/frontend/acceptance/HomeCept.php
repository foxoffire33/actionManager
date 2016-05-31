<?php
use tests\codeception\frontend\AcceptanceTester;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that home page works');
$I->amOnPage(Yii::$app->homeUrl);
$I->see('yii2-enhanced');
$I->seeLink('About');
$I->click('About');
$I->see('This is the About page.');
