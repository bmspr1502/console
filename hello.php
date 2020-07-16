<?php
session_start();
$con = mysqli_connect("localhost", "root", "", "website");
if(!$con){
    die("Connection not done" . mysqli_error($con));
} else{
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
<div class="container">
    <?php
    $query = "SELECT * FROM page";
    if($result = mysqli_query($con, $query)){
        $content = mysqli_fetch_assoc($result);
    ?>
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
        $imgres = mysqli_query($con, "SELECT * FROM images");
        while ($row = mysqli_fetch_array($imgres)) {

        echo "<div class='card' style=\"width:200px\">";
        echo "<div class='card-body'>";
        echo "<img class='card-img-top' src='admin/images/".$row['image']."' >";
            echo "<h4 class='card-title'>".$row['image_text']."</h4></div>";
            echo "</div>";
        }
        ?>
    </div>
</div>
</div>
<?php
}
    mysqli_close($con);
}
?>
</body>
</html>