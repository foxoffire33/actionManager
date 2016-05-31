<?php

use tests\codeception\backend\FunctionalTester;
use tests\codeception\common\_pages\AccountUpdatePage;

/* @var $scenario Codeception\Scenario */

$I = new FunctionalTester($scenario);
$I->wantTo('ensure account creation works');

$accountCreatePage = AccountUpdatePage::openBy($I);

$I->amGoingTo('try to create account with wrong data');
$I->expectTo('see validations errors');
$accountCreatePage->update('wrongemail@com', '12312hjvghd', '1o2bieu1fvu4');
$I->expectTo('see validations errors');
$I->see('E-mail is not a valid email address.', '.help-block');
$I->see('Repeat Password must be equal to "Enter Password".', '.help-block');

$I->amGoingTo('try to create account with correct credentials');
$accountCreatePage->update('member_2@email.com', 'Qwerty12345', 'Qwerty12345');
$I->expectTo('see that account is updated');
$I->seeLink('Update');
$I->see('Created At');
$I->see('Updated At');
$I->see('member_2@email.com');