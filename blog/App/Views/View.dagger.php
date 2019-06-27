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
  <div class="container">
  <h2>This page for single data:</h2>
    <div class="card">
    <div class="card-body">
      <h4 class="card-title"><?php echo $dataPost->title; ?></h4>
      <p class="card-text"><?php echo $dataPost->description; ?></p>
    </div>
  </div>
</div>


</div>

</body>
</html>
