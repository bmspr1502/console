<?php
session_start();
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
    <h1>
        The Datas visible
    </h1>
    <div class="card" id="data">
    </div>
    <p id="message"></p>
</div>

<script>
    window.onload = function () {
        getTable();
    }
    function getTable() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if(this.readyState == 4 && this.status){
                document.getElementById('data').innerHTML = this.responseText;
            }
        };
        xmlhttp.open('GET', 'tabledata.php', true);
        xmlhttp.send();
    }

    function changeVisibility(id, visibility){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if(this.readyState == 4 && this.status){
                document.getElementById('message').innerHTML = this.responseText;
            }
        };
        xmlhttp.open('GET', 'visibility.php?id='+id+'&visibility='+visibility, true);
        xmlhttp.send();
        setTimeout(
            function () {
                getTable();
            }, 500);
    }
</script>
</body>
</html>