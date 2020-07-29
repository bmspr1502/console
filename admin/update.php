<?php
if(isset($_POST['submit'])) {

    $conwr = mysqli_connect("localhost", "root", "", "website");
    if(!$conwr){
        die("Connection not done" . mysqli_error($con));
    } else {
        $header = mysqli_real_escape_string($conwr, $_POST['header']);
        $body = mysqli_real_escape_string($conwr,$_POST['body']);
        $video = mysqli_real_escape_string($conwr,$_POST['video']);
        $video_title = mysqli_real_escape_string($conwr, $_POST['video_title']);
        $query = "UPDATE page 
                     SET header='" . $header."', 
                     body='" . $body."',
                     video = '". $video."',
                     video_title = '". $video_title ."' WHERE id = 1";
        if(!mysqli_query($conwr, $query)){
            die("Not written" . mysqli_error($conwr));
        } else{
            echo "<br>Updated successfully";

        }

            $image = $_FILES['image']['name'];
            // Get text
        if($image) {
            $image_text = mysqli_real_escape_string($conwr, $_POST['image_text']);

            // image file directory
            $target = "images/" . basename($image);

            $sql = "INSERT INTO images (image, image_text) VALUES ('$image', '$image_text')";
            // execute query
            mysqli_query($conwr, $sql);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                $msg = "Image uploaded successfully";
            } else {
                $msg = "Failed to upload image";
            }
            echo $msg;
        }
    }
}

