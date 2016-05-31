<?php

namespace tests\codeception\common\_pages;

use yii\codeception\BasePage;

/**
 * Represents role/create page
 * @property \codeception_frontend\AcceptanceTester|\codeception_frontend\FunctionalTester|\codeception_backend\AcceptanceTester|\codeception_backend\FunctionalTester $actor
 */
class RoleCreatePage extends BasePage
{
	public $route = 'user/role/create';

	/**
	 * @param string $name
	 * @param string $description
	 */
	public function create($name, $description)
	{
		$this->actor->fillField('input[name="Role[name]"]', $name);
		$this->actor->fillField('input[name="Role[description]"]', $description);

		$this->actor->click('role-button');
	}
}