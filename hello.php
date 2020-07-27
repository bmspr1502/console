<?php
session_start();
if(isset($_POST['refresh'])){
    unset($_COOKIE['content']);
    unset($_COOKIE['images']);
}
if(isset($_COOKIE['content']) &&isset($_COOKIE['images'])){
    $content = json_decode($_COOKIE['content'], true);
    $images = json_decode($_COOKIE['images'], true);
} else {
    $con = mysqli_connect("localhost", "root", "", "website");
    if (!$con) {
        die("Connection not done" . mysqli_error($con));
    } else {
        $query = "SELECT * FROM page";
        if ($result = mysqli_query($con, $query)) {
            $content = mysqli_fetch_assoc($result);
            setcookie('content', json_encode($content), time() + 86400);
            $imgres = mysqli_query($con, "SELECT * FROM images");
            $images = array();
            while($imgrow = mysqli_fetch_array($imgres)){
                array_push($images, $imgrow);
            }
            setcookie('images', json_encode($images), time() + 86400);
        }
    }
    mysqli_close($con);
    header('Location:hello.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Post</title>
</head>

<body>
<form action="hello.php" method="post">
    <input class="float-right btn btn-outline-success" type="submit" name="refresh" value="Refresh cookies">
</form>
<div class="container">
<div class="card">
    <div class="card-header"><h1><?php echo $content['header'];?></h1></div>
    <div class="card-body text-monospace"><?php echo $content['body'];?></div>
    <div class="card-body">
        <div class="jumbotron">
            <h3 class="card-title"><?php echo $content['video_title'];?></h3>
            <iframe class="mx-auto" style="width:500px" height="300px" src="<?php echo $content['video'];?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
    </div>
    <div class="card-body card-group">
        <?php
        foreach ($images as $img) {

        echo "<div class='card' style=\"width:200px\">";
        echo "<div class='card-body'>";
        echo "<img class='card-img-top' src='admin/images/".$img['image']."' >";
            echo "<h4 class='card-title'>".$img['image_text']."</h4></div>";
            echo "</div>";
        }

        ?>
    </div>
</div>
</div>

</body>
</html>