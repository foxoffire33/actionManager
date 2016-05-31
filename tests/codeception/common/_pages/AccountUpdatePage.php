<?php

namespace tests\codeception\common\_pages;

use yii\codeception\BasePage;

/**
 * Represents loging page
 * @property \codeception_frontend\AcceptanceTester|\codeception_frontend\FunctionalTester|\codeception_backend\AcceptanceTester|\codeception_backend\FunctionalTester $actor
 */
class AccountUpdatePage extends BasePage
{
	public $route = 'user/account/update?id=2';

	/**
	 * @param string $email
	 * @param string $enter_password
	 * @param string $repeat_password
	 */
	public function update($email, $enter_password, $repeat_password)
	{
		$this->actor->fillField('input[name="User[email]"]', $email);
		$this->actor->fillField('input[name="User[enter_password]"]', $enter_password);
		$this->actor->fillField('input[name="User[repeat_password]"]', $repeat_password);

		$this->actor->click('account-button');
	}
}