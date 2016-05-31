<?php

namespace frontend\models\forms;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
	/** @var   */
	public $name;
	/** @var   */
	public $email;
	/** @var   */
	public $subject;
	/** @var   */
	public $body;
	/** @var   */
	public $verifyCode;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name', 'email', 'subject', 'body'], 'required'], // name, email, subject and body are required
			['email', 'email'], // email has to be a valid email address
			['verifyCode', 'captcha'], // verifyCode needs to be entered correctly
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'name'       => Yii::t('contact', 'Name'),
			'email'      => Yii::t('contact', 'Email'),
			'subject'    => Yii::t('contact', 'Subject'),
			'body'       => Yii::t('contact', 'Body'),
			'verifyCode' => Yii::t('contact', 'Verification Code'),
		];
	}

	/**
	 * Sends an email to the specified email address using the information collected by this model.
	 *
	 * @param  string $email the target email address
	 * @return boolean whether the email was sent
	 */
	public function sendEmail($email)
	{
		return Yii::$app->mailer->compose()
			->setTo($email)
			->setFrom([$this->email => $this->name])
			->setSubject($this->subject)
			->setTextBody($this->body)
			->send();
	}
}
