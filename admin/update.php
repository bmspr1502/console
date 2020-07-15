<?php
if(isset($_POST['submit'])) {
    $header = $_POST['header'];
    $body = $_POST['body'];
    $conwr = mysqli_connect("localhost", "root", "", "website");
    if(!$conwr){
        die("Connection not done" . mysqli_error($con));
    } else {
        $query = "UPDATE page SET header='" . $header."', body='" . $body."' WHERE id = 1";
        if(!mysqli_query($conwr, $query)){
            die("Not written" . mysqli_error($conwr));
        } else{
            echo "<br>Updated successfully";

        }
    }
}

