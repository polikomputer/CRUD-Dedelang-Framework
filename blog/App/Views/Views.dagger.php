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
  <h1>This page for display all post</h1>

  <div class="list-group">
    <?php foreach ($dataPosts as $dataPost): ?>
      <div class="list-group-item">
        <h4 class="list-group-item-heading"><?php echo $dataPost->title; ?> </h4>
        <p class="list-group-item-text"><?php echo $dataPost->description; ?>
        <a href="<?php echo base_url('posts/view/'.$dataPost->id); ?>">View</a>
        <a href="<?php echo base_url('posts/update/'.$dataPost->id); ?>">Update</a>
        <a href="<?php echo base_url('posts/delete/'.$dataPost->id); ?>" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
      </div>
    <?php endforeach; ?>

</div>


</div>

</body>
</html>
