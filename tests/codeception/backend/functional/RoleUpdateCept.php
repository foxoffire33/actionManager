<?php

use tests\codeception\backend\FunctionalTester;
use tests\codeception\common\_pages\RoleUpdatePage;

/* @var $scenario Codeception\Scenario */

$I = new FunctionalTester($scenario);
$I->wantTo('ensure account creation works');

$roleCreatePage = RoleUpdatePage::openBy($I);

$I->amGoingTo('try to create account with correct credentials');
$roleCreatePage->update('Updated API description');
$I->expectTo('see that account is updated');
$I->seeLink('Update');
$I->see('Created At');
$I->see('Updated At');
$I->see('Updated API description');