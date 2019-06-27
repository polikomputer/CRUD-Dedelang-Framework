<?php

namespace Controllers;

use Dedelang\View\View;

use Models\PostsModel;

class PostsController{

	public static function index(){

		if(http_method() === "POST"){

			echo (PostsModel::insert()? "Success insert post" : "Failed insert post");

			self::views();

		}else{

			View::body('Posts');

		}


	}

	public static function views(){

		view::render('Views',['dataPosts'=>PostsModel::getAll()]);

	}

	public static function view(){ // this function for single row of data

		view::render('View',['dataPost'=>PostsModel::get()]);


	}

	public static function update(){

		if(http_method() === "POST"){

			echo (PostsModel::update()? "Success update post" : "Failed Update post");

			self::views();

		}else{

			View::render("Update",['dataPost'=>PostsModel::get()]); // we need created new page for update from

		}
	}

	public static function delete(){

		echo (PostsModel::delete()? "Success delete post" : "Failed delete post");

		self::views();
	}

}
?>
