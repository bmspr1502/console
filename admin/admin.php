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
    <a href="admin.php"><button type="button" class="btn btn-primary" > Click to refresh </button></a>
    <div class="form-group">
    <form action="admin.php" method="post" enctype="multipart/form-data">
        <p><label for="header">Header: </label><input class="form-control" type="text" name="header" value="<?php echo $content["header"];?>"></p>
        <p><label for="body">Body: </label><textarea class="form-control" rows="5" name="body"><?php echo $content["body"];?></textarea></p>
        <br><label for="video">Video Id :</label><input class="form-control" type="text" name="video" value="<?php echo $content['video'];?>">
        <br><label for="video_title">Video Title:</label><input class="form-control" type="text" name="video_title" value="<?php echo $content['video_title'];?>">
        <br><input type="hidden" name="size" value="1000000">
        <input class="form-control-file border" type="file" name="image">
        <br>
        <textarea
                id="text"
                cols="40"
                rows="4"
                name="image_text"
                placeholder="Say something about this image..."></textarea>
        <br>
        <input type="submit" name="submit" value="post">
    </form>
    </div>

    <?php
    if(isset($_SESSION['delete_message'])){
        echo $_SESSION['delete_message'];
        unset($_SESSION['delete_message']);
    }
    ?>
    <div class="card-group">
    <?php
    $imgres = mysqli_query($con, "SELECT * FROM images");
    while ($row = mysqli_fetch_array($imgres)) {

        echo "<div class='card' style=\"width:200px\">";
        echo "<img class='card-img-top' src='images/".$row['image']."' >";
        ?>
        <div class='card-body'>
        <form action="delete_pic.php" method="post">
            <input type="hidden" name="image" value="<?php echo $row['image'];?>">
            <input type="submit" name="delete" value="Delete pic">
        </form>
    <?php
        echo "<h4 class='card-title'>".$row['image_text']."</h4></div>";
        echo "</div>";
    }
    mysqli_close($con);
    }

    }
    ?>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>