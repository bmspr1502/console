<?php
session_start();
include 'update.php';
$con = mysqli_connect("localhost", "root", "", "website");
if(!$con){
    die("Connection not done" . mysqli_error($con));
}
else{
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>
</head>

<body>
<?php
    $query = "SELECT * FROM page";
    if($result = mysqli_query($con, $query)){
    $content = mysqli_fetch_assoc($result);
?>
<div class="container">
    <div class="form-group">
    <form action="admin.php" method="post">
        <p><label for="header">Header: </label><input class="form-control" type="text" name="header" value="<?php echo $content["header"];?>"></p>
        <p><label for="body">Body: </label><textarea class="form-control" rows="5" name="body"><?php echo $content["body"];?></textarea></p>
        <input type="submit" name="submit" value="post">
    </form>
    </div>
    <?php
    mysqli_close($con);
    }

    }
    ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>