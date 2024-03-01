<?php
include 'connection.php';
$id_appointment = $_POST['id_appointment'];
$rating_value = $_POST['rating_value'];
$comment = $_POST['comment'];

try {
    $sql = "INSERT INTO rating (id_appointment, rating_value, comment) VALUES (?, ?, ?)";
    $statement = $connection->prepare($sql);
    $statement->bind_param('ids', $id_appointment, $rating_value, $comment);
    if ($statement->execute()) {
        echo "Rating added successfully.";
    }
    $statement->close();
    $connection->close();
} catch (Exception $e) {
    echo "You already gave a rating for this experience!";
}
?>
