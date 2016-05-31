<?php
use tests\codeception\api\ApiTester;

$I = new ApiTester($scenario);
$I->wantTo('Login admin user');

$I->sendPOST('user/login', ['username' => 'admin', 'password' => 'password_0']);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains("1Uu1qHcde0diwUol3xeI");

$I->wantTo('Login organization admin');

$I->sendPOST('user/login', ['username' => 'org2', 'password' => 'password_0']);

$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContains("5Uu1qHcde0diwUol3xeI");

// Done