<?php
namespace Dedelang\Engine;

use Dedelang\Engine\Route;

use Dedelang\Engine\Loader;

use Dedelang\Engine\Controller;

use Dedelang\Engine\URL;

use Dedelang\Http\Request;

use Dedelang\Http\Url as link;

use Dedelang\Engine\Security\Attack;


class Application{

	protected static $action;

	protected static $method;

	protected static $session_level;

	protected static $session_value;

	protected static $error_url;



	public static function validationUrl(){

		if(!URL::validation()){

			include("vendor/Dedelang/View/Template/404.php");

			die();

		}
	}
	public static function run(){

			self::validationUrl();

			$url = URL::get();

			$urlnum = count($url);

			foreach (Route::routes() as $value) {

				$road =  URL::get_array($value['url']);

				$roadnum = count($road);

				$valueMust = $urlnum - $roadnum;

				if($valueMust==count(array_diff_assoc($url,$road))){

					self::get(array_diff_assoc($url,$road));

					self::$action = $value['action'];

					self::$method = $value['method'];

					self::$session_level = $value['session_level'];

					// self::$session_value = $value['session_value'];

					self::$error_url = $value['error_url'];

					self::forward();

         			break;
       			}
		  }

	}

	public static function forward(){

		(!empty(self::$session_level) ? self::check_authorization() : '');

		(http_method()==="POST" || http_method()==="GET" ? Controller::load(self::$action) : Attack::display_error('Changing Request Method'));

		// (self::$method!=Request::server('REQUEST_METHOD') ? Attack::display_error('Changing Request Method') :'');

		// Controller::load(self::$action);

	}
	public static function check_authorization(){
		if(!empty(self::$session_level) && isset($_SESSION[encrypt("role")])){
			$role = $_SESSION[encrypt("role")];

			($role !== encrypt(self::$session_level) ? link::redirect(self::$error_url) : '');
			// ($role !== encrypt(self::$session_level) ? self::error_result("Error Message: no session active") : '');

			// ($_SESSION[self::$session_level]!=self::$session_value? Attack::display_error('Changing session value'):'');

		}else{
			// self::error_result("Error Message: Your can't access the restriction area");
			link::redirect(self::$error_url);
		}

	}

	public static function get($datas){

		$x=1;

		foreach ($datas as $data) {

			$_GET["p".$x] = safe($data);

			$x++;

		}

	}

	private static function error_result($e,$file="login Page"){

		include("vendor/Dedelang/View/Template/error.php");

		die();
	}


}
