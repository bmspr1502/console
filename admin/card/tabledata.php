<?php
include 'DB.php';
$query = "SELECT * FROM info";
$result = $con->query($query);

if($result->num_rows > 0){
    ?>
    <table class="table table-dark table-striped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Visibility</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($row = $result->fetch_assoc()){
            ?>
            <tr>
                <td><?php echo $row['id'];?></td>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row['content'];?></td>
                <td>
                <?php if($row['visibility']==1){
                    echo "<button class=\"btn btn-success\" onclick=\"changeVisibility(" . $row['id'] .", ".$row['visibility']." )\" >";
                    echo "Visible";
                }else{
                    echo "<button class=\"btn btn-danger\" onclick=\"changeVisibility(" . $row['id'] .", ".$row['visibility']." )\" >";
                    echo "Not Visible";
                }
                    ?></button></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
<?php
}
else{
    echo "NO DATA";
}
$con->close();