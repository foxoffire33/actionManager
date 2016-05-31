<?php
use tests\codeception\api\ApiTester;

$I = new ApiTester($scenario);

$I->wantTo('Authenticate the user');
$I->amHttpAuthenticated('4Uu1qHcde0diwUol3xeI-18MuHkkprQI', '');
$I->haveHttpHeader('Content-Type', 'application/x-www-form-urlencoded');

// Contact index
$I->wantTo('contact/index');
$I->sendGET('contact');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContainsJson(
	[
		[
			'id'          => 1,
			'name'        => 'Contact 1',
			'contactType' => [
				'name' => 'Naam 1'
			],
		],
		[
			'id'          => 3,
			'name'        => 'Contact 3',
			'contactType' => [
				'name' => 'Naam 2'
			]
		]
	]
);

// Contact view
$I->wantTo('contact/view');
$I->sendGET('contact/1');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContainsJson(
	[
		'id'          => 1,
		'name'        => 'Contact 1',
		'contactType' => [
			'information' => 'Omschrijving 1',
		],
	]
);

// Contact create
$I->wantTo('contact/create');
$I->sendPOST('contact', [
	'name'            => 'Nieuw contact',
	'contact_type_id' => 1,
]);
$I->seeResponseCodeIs(201); // 201 @ create
$I->seeResponseIsJson();
$I->seeResponseContainsJson(
	[
		'name' => 'Nieuw contact',
	]
);

// Contact update
$I->wantTo('contact/update');
$I->sendPATCH('contact/4', [
	'name'            => 'Bijgewerkt contact',
	'contact_type_id' => 1,
]);
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContainsJson(
	[
		'id'          => 4,
		'name'        => 'Bijgewerkt contact',
		'contactType' => [
			'id' => 1,
		]
	]
);