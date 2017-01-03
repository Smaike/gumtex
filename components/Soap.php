<?php 
namespace app\components;

use yii\base\Component;

Class Soap extends Component
{
	public $login;
	public $password;
	public $wsdlpath;

	private $sc;

	public function init()
	{
		parent::init();
		$this->sc = new \SoapClient($this->wsdlpath,[
			'login' => $this->login,
			'password' => $this->password,
		]);
	}

	public function getSc()
	{
		return $this->sc;
	}

}