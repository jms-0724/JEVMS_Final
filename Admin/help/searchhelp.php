<?php
require_once(__DIR__ . '/../../connections/connection.php');

$search = isset($_POST['search']) ? $_POST['search'] : '';
$stmt = $conn->prepare("SELECT * FROM tbl_help WHERE topic LIKE :search");
$searchTerm = "%$search%";
$stmt->bindValue(':search', $searchTerm, PDO::PARAM_STR);

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($result) {
    foreach ($result as $row) {
        ?>
        <div>
            <a href="javascript:void(0)" onclick="fetchHelpText(<?= $row['help_id'] ?>)" class="btn-link">
                <?= htmlspecialchars($row['topic']) ?>
            </a>
        </div>
        <?php
    }
} else {
    echo '<div>No Records Found</div>';
}
?>
