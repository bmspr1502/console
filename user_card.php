<?php
session_start();
if(isset($_POST['refresh'])){
    unset($_SESSION['results']);
}
if(!isset($_SESSION['results'])) {
    include './admin/card/DB.php';
    $query = "SELECT * FROM info WHERE visibility=1";
    $result = $con->query($query);
    $results = array();
    while($data = $result->fetch_assoc()){
        array_push($results, $data);
    }
    $_SESSION['results'] = $results;
    $con->close();
    header('Location: user_card.php');
}
$results = $_SESSION['results'];
//var_dump($results);
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
<form action="user_card.php" method="post">
    <input class="float-right btn btn-outline-success" type="submit" name="refresh" value="Refresh cookies">
</form>
<div class="container">
    <h1>The ads cards</h1>

        <?php
        if(sizeof($results)>0){
        ?>
        <div class="card carousel">
            <div id="card_data"></div>
            <button class="carousel-control-prev btn btn-primary" id="prev" onclick="showCard('prev')">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next btn btn-primary" id='next' onclick="showCard('next')">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
        <?php
        }else{
            echo "NO DATA FOUND";
        }
        ?>

</div>
<script>

    const xmlhttp = new XMLHttpRequest();
    let num = 0;
    function showFirstCard() {
        xmlhttp.onreadystatechange = function () {
            if(this.readyState==4 && this.status==200){
                document.getElementById("card_data").innerHTML = this.responseText;
            }
        };
        xmlhttp.open('POST', "card_data.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send("card_num=0");
        buttonChange();
    }
    function showCard(str){
        if(str==='prev'){
            if(num>0){
                num--;
                console.log(num);
                xmlhttp.onreadystatechange = function () {
                    if(this.readyState==4 && this.status==200){
                        document.getElementById("card_data").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open('POST', "card_data.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("card_num="+num);
            }
        } else if(str==='next'){
            if(num< Number(<?php echo count($results)?>)-1){
                num++;
                console.log(num);
                xmlhttp.onreadystatechange = function () {
                    if(this.readyState==4 && this.status==200){
                        document.getElementById("card_data").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open('POST', "card_data.php", true);
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("card_num="+num);
            }
        }
        buttonChange();
    }

    function buttonChange(){
        if(Number(<?php echo count($results)?>) - 1===0){
            document.getElementById('prev').className = 'carousel-control-prev btn btn-danger disabled ';
            document.getElementById('prev').disabled = 'disabled';
            document.getElementById('next').className = 'carousel-control-next btn btn-danger disabled';
            document.getElementById('next').disabled = 'disabled';
        } else if(num===Number(<?php echo count($results)?>) - 1){
            document.getElementById('prev').className = 'carousel-control-prev btn btn-success ';
            document.getElementById('prev').disabled = '';
            document.getElementById('next').className = 'carousel-control-next btn btn-danger disabled';
            document.getElementById('next').disabled = 'disabled';
        } else if(num===0){
            document.getElementById('prev').className = 'carousel-control-prev btn btn-danger disabled';
            document.getElementById('prev').disabled = 'disabled';
            document.getElementById('next').className = 'carousel-control-next btn btn-success';
            document.getElementById('next').disabled = '';
        }else {
            document.getElementById('prev').className = 'carousel-control-prev btn btn-success ';
            document.getElementById('prev').disabled = '';
            document.getElementById('next').className = 'carousel-control-next btn btn-success';
            document.getElementById('next').disabled = '';
        }
    }
    window.onload = function(){ showFirstCard();};
</script>
</body>
</html>