<?php

require_once(__DIR__ . '/../../connections/connection.php');

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM tbl_account_class WHERE class_id LIKE '%$search%' OR class_name LIKE '%$search%'");
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_account_class ORDER BY class_name");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
        <tr>
            <td><?=$row['class_name']?></td>
            <td><?=$row['description']?></td>
            
            
            <td>
            <div class="dropdown">
            <button class="btn dropdown-toggle text-white" style="background-color:#004d68;" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" onclick="editAccountGroup(<?=$row['class_id']?>)">Update Account</a></li>
                </ul>
            </div>
            </td>
        </tr>
        <?php
    }
} else {
    ?>
        <td colspan="5">No Records Found</td>
    <?php 
}
?>