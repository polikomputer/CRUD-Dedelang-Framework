<?php

namespace Models;

use Dedelang\Engine\DB\Query;

use Dedelang\Http\Request;

use Dedelang\Engine\Validate;


class PostsModel{

	public static function get(){
		extract(Request::getAll());
		$data = Query::table('posts')
									->select('*')
									->where('id','=',$p1)
									->getOne();
		return $data;

	}

  public static function getAll(){

		$data = Query::table('posts')
									->select('*')
									->getAll();
		return $data;

	}

  public static function insert(){

		extract(Request::postAll());
		return Query::table('posts')
					 ->insert('title','description')
					 ->values($title,$description)
					 ->run();

	}

  public static function update(){
		extract(Request::postAll());
		return Query::table('posts')
					->update('title','description')
					->values($title,$description)
					->where('id','=',$id)
					->run();

	}

  public static function delete(){
		extract(Request::getAll());
		return Query::delete('posts')
					->where('id','=',$p1)
					->run();

	}

}
?>
