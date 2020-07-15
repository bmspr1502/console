<?php
session_start();
if(isset($_POST['delete'])){
    $image = $_POST['image'];

    $con = mysqli_connect("localhost", "root", "", "website");
    if(!$con){
        die("Connection not done" . mysqli_error($con));
    } else {

            $query = "DELETE FROM images WHERE image='$image'";
        if(!mysqli_query($con, $query)){
            $_SESSION['delete_message'] = "Not Deleted";
        } else{
            if(unlink('images/' . $image)){
            $_SESSION['delete_message'] = "Deleted Successfully";
                header('Location: admin.php');
        }}
    }
} else {
    header('Location: admin.php');
}