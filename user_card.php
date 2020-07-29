<?php
session_start();
if(!isset($_SESSION['result'])) {
    include './admin/card/DB.php';
    $query = "SELECT * FROM info WHERE visibility=1";
    $result = $con->query($query);
    $_SESSION['result'] = $result;
    $con->close();
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
<div class="container">
    <h1>The ads cards</h1>
    <div class="container bg-primary text-white">
        <div class="card">

        </div>
    </div>
</div>
</body>