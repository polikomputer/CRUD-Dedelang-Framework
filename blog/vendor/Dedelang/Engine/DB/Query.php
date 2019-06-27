<?php

namespace Dedelang\Engine\DB;

use Dedelang\Engine\DB\Quezy;

class Query extends Quezy{

	protected static $fieldLazy="id";
	
	protected static $conditionLazy="=";

	public static function post(){
	  foreach($_POST as $key => $val) {
	    ($key!="csrf" ? array_push(self::$values,htmlspecialchars($val)) : '');
	    ($key!="csrf" ? array_push(self::$fields,htmlspecialchars($key)) : '');
	  }
	  return new self();
	}

	public static function save($table){

		self::post();

		return Quezy::table($table)
					->insert()
					->values()
					->run();

		// return new self();

	}
	public static function condition($fieldLazy,$conditionLazy,$valueLazy){
		self::$fieldLazy = $fieldLazy;
		self::$conditionLazy = $conditionLazy;
		self::$valueLazy = $valueLazy;
		return new self();
	}

	public static function changes($table){

		self::post();

		Quezy::table($table)
					->update()
					->values()
					->where(self::$fieldLazy,self::$conditionLazy,self::$valueLazy)
					->run();

		return new self();

	}
	public static function checkDuplicate(){

	}

	public static function maxid($table){
		$data = Query::table($table)
							 ->select('MAX(id) as max_id')
							 ->getOne();

		return $data->max_id;
	}


}
 ?>
