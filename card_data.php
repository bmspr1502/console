<?php
session_start();
if($_SERVER['REQUEST_METHOD']=="POST"){
    $id = $_REQUEST['card_num'];
    if(isset($_SESSION['results'])){
        $results = $_SESSION['results'];
        ?>
        <div class="card-body">
            <div class="card-title text-center">
                <h1><?php echo $results[$id]['title'];?></h1>
            </div>
            <div class="card-text text-center">
                <?php echo $results[$id]['content'];?>
            </div>
        </div>
<?php
    }else{
        echo "NOT SET";
    }
}else{
    echo "No DATA";
}