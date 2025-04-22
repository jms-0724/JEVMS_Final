<?php

require_once(__DIR__ . '/../../connections/connection.php');

if(isset($_POST['search'])){
    $search = $_POST['search'];
    $stmt = $conn->prepare("SELECT * FROM tbl_fiscal_year WHERE fiscal_id LIKE '%$search%' OR description LIKE '%$search%'");
} else {
    $stmt = $conn->prepare("SELECT * FROM tbl_fiscal_year ORDER BY description");
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row){
        ?>
        <tr>
            <td id="<?=$row['fiscal_id']?>" class="fiscalList"><?=$row['description']?></td>
            <td><?=$row['start_date']?></td>
            <td><?=$row['end_date']?></td>
            <td class="status2"><?=$row['fiscal_status']?></td>
            
            
            <td>
            <!-- <div class="dropdown">
            <button class="btn dropdown-toggle text-white" style="background-color:#004d68;" type="button" data-bs-toggle="dropdown" aria-expanded="false">Actions</button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" onclick="editFiscal(<?=$row['fiscal_id']?>)">Update Status</a></li>
                </ul>
            </div> -->
            <?php 
            if($row['fiscal_status'] === "Active"){
                ?>
                <button class="btn mx-2 text-white" style="background-color:#004d68;" disabled>Activated</button>
                <?php

            } else {
                ?>
                <button class="btn mx-2 text-white activateBTN" style="background-color:#004d68;">Activate</button>
                <?php
            }
            ?>
           
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