<?php

use tests\codeception\backend\FunctionalTester;
use tests\codeception\common\_pages\AccountCreatePage;

/* @var $scenario Codeception\Scenario */

$I = new FunctionalTester($scenario);
$I->wantTo('ensure account creation works');

$accountCreatePage = AccountCreatePage::openBy($I);

$I->amGoingTo('submit account form with no data');
$accountCreatePage->create('', '', '', '', '');
$I->expectTo('see validations errors');
$I->see('Username cannot be blank.', '.help-block');
$I->see('Password cannot be blank.', '.help-block');

$I->amGoingTo('try to create account with wrong data');
$I->expectTo('see validations errors');
$accountCreatePage->create('admin', 'wrongemail@com', '12312hjvghd', '1o2bieu1fvu4', 'admin');
$I->expectTo('see validations errors');
$I->see('E-mail is not a valid email address.', '.help-block');
$I->see('Repeat Password must be equal to "Enter Password".', '.help-block');

$I->amGoingTo('try to create account with correct data');
$accountCreatePage->create('admin_2', 'admin2@email.com', 'Qwerty12345', 'Qwerty12345', 'admin');
$I->expectTo('see that account is created');
$I->seeLink('Update');
$I->see('Created At');
$I->see('Updated At');