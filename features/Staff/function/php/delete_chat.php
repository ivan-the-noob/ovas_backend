<?php
require '../../../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM chat_messages WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: ../../web/api/chat-bot.php'); 
    exit();
}
?>
