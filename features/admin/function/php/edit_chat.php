<?php
require '../../../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['question'], $_POST['response'])) {
    $id = $_POST['id'];
    $question = $_POST['question'];
    $response = $_POST['response'];

    $stmt = $conn->prepare("UPDATE chat_messages SET question = ?, response = ? WHERE id = ?");
    $stmt->execute([$question, $response, $id]);

    header('Location: ../../web/api/chat-bot.php'); 
    exit();
}
?>