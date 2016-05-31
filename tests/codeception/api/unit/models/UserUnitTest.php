<?php

class UserUnitTest extends \Codeception\TestCase\Test
{
	/**
	 * @var \UnitTester
	 */
	protected $user;

//	protected function _before()
//	{
//		// Do before test
//	}
//
//	protected function _after()
//	{
//		// Do after test
//	}

	/**
	 * Test the user
	 */
	public function testUserModel()
	{
		$user = new \common\models\User;
		$user->scenario = 'register';

		$user->email = null;
		$this->assertFalse($user->validate(['email']));

		$user->email = 'asd'; // Email not valid
		$this->assertFalse($user->validate(['email']));

		$user->email = 'edofre@releaz.nl';
		$this->assertTrue($user->validate(['email']));

		$this->assertTrue(true);
		$this->assertFalse(false);

		verify($user->email)->equals('edofre@releaz.nl');
	}
}