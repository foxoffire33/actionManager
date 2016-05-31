<?php

use tests\codeception\backend\FunctionalTester;
use tests\codeception\common\_pages\RoleCreatePage;

/* @var $scenario Codeception\Scenario */

$I = new FunctionalTester($scenario);
$I->wantTo('ensure role creation works');

$roleCreatePage = RoleCreatePage::openBy($I);

$I->amGoingTo('submit role form with no data');
$roleCreatePage->create('', '');
$I->expectTo('see validations errors');
$I->see('Name cannot be blank.', '.help-block');
$I->see('Description cannot be blank.', '.help-block');

$I->amGoingTo('try to create role with correct data');
$roleCreatePage->create('api', 'API user access');
$I->expectTo('see that role is created');
$I->seeLink('Update');
$I->see('Created At');
$I->see('Updated At');