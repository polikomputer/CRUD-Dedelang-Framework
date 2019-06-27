<!DOCTYPE html>
<html lang="en">
<head>
  <title>Posts</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<div class="col-xs-12" style="height:10px;"></div>
<div class="container jumbotron-fluid">
<center>
  <h1>Update Post</h1>
  <form action="posts/update" method="POST"> <?php  Html::csrf(); ?>
  <input type="hidden" name="id" value="<?php echo $dataPost->id; ?>">
  Title: <input type="text" name="title" value="<?php echo $dataPost->title; ?>"><br>
  Description: <input type="text" name="description" value="<?php echo $dataPost->description; ?>"><br>
  <input type="submit" value="Submit">
</form>

</center>
</div>

</body>
</html>
