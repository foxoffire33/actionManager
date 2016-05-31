<?php

namespace tests\codeception\common\fixtures;

use yii\test\ActiveFixture;

/**
 * AuthAssignment fixture
 */
class AuthAssignmentFixture extends ActiveFixture
{
	public $tableName = 'auth_assignment';

	public $depends = [
		'tests\codeception\common\fixtures\UserFixture',
		'tests\codeception\common\fixtures\AuthItemFixture',
	];
}
