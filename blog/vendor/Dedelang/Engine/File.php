<?php

namespace Dedelang\Engine;


class File{

  protected static $file;

  protected static $uploads_dir = "public/images/";

  protected static $name;

  protected static $result = false;

  protected static $ext;

  public static function upload($path = ""){

    self::$uploads_dir = self::$uploads_dir.$path;

    $result = (move_uploaded_file($_FILES[self::$file]['tmp_name'], self::$uploads_dir.self::$name) ? true : false);

    self::reset();

    return $result;


  }

  public static function name($file){

    self::$file = $file;

    self::$name = $_FILES[$file]['name'];

    return new self();

  }

  public static function random($file){

      self::$file = $file;

      self::$ext = pathinfo($_FILES[$file]['name'], PATHINFO_EXTENSION);

      self::$name = md5(uniqid(rand(), true).$_FILES[$file]['name']).".".self::$ext;

      return new self();

  }

  public static function reset(){
    self::$file=null;

    self::$uploads_dir = "public/images/";

    self::$name=null;

    self::$result = false;

    self::$ext=null;
  }


}
