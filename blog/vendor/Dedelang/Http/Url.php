<?php
namespace Dedelang\Http;

class Url{

	public function redirect($path){

			 header('location:' . getenv('BASE_URL').$path);

			 exit();

	 }
}



 ?>
