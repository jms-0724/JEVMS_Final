<?php
require_once(__DIR__ . '/../../connections/connection.php');

if (isset($_GET['help_topic_id'])) {
    $help_topic_id = $_GET['help_topic_id'];

    // Fetch help topic
    $sql1 = $conn->prepare("SELECT * FROM tbl_help WHERE help_id = :help_id");
    $sql1->bindParam(':help_id', $help_topic_id, PDO::PARAM_INT);
    $sql1->execute();
    $help_topic = $sql1->fetch();

    // Fetch help items related to this topic
    $sql2 = $conn->prepare("SELECT * FROM tbl_help_items WHERE help_id = :help_id");
    $sql2->bindParam(':help_id', $help_topic_id, PDO::PARAM_INT);
    $sql2->execute();
    $help_items = $sql2->fetchAll(PDO::FETCH_ASSOC);

    if ($help_topic && $help_items) {
        ?>
        <!-- <center><div class="h3">User Guide</div></center> -->
         <!-- <input type="text" class="form-control" placeholder="Ask about us" aria-label="Search" aria-describedby="search-icon" id="searchInfo2"> -->

        <?php
        // Output the topic and its help text in HTML
        echo "<h2>" . htmlspecialchars($help_topic['topic']) . "</h2>";

        foreach ($help_items as $item) {
            echo '<img src="'.htmlspecialchars($item['photo_documentation']) . '" alt="..Help Item Image" class="img-fluid">';
            echo "<p>" . htmlspecialchars($item['help_text']) . "</p>";
        }
    } else {
        echo "No content found for this topic.";
    }
}
?>