<?php

namespace tests\codeception\common\_pages;

use yii\codeception\BasePage;

/**
 * Represents loging page
 * @property \codeception_frontend\AcceptanceTester|\codeception_frontend\FunctionalTester|\codeception_backend\AcceptanceTester|\codeception_backend\FunctionalTester $actor
 */
class RoleUpdatePage extends BasePage
{
	public $route = 'user/role/update?id=member';

	/**
	 * @param string $description
	 */
	public function update($description)
	{
		$this->actor->fillField('input[name="Role[description]"]', $description);

		$this->actor->click('role-button');
	}
}