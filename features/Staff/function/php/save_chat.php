<?php 
require '../../../../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question = $_POST['question'];
    $response = $_POST['response'];

    try {
        $sql = "INSERT INTO chat_messages (question, response) VALUES (:question, :response)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':question', $question, PDO::PARAM_STR);
        $stmt->bindParam(':response', $response, PDO::PARAM_STR);

        if ($stmt->execute()) {
            header("Location: ../../web/api/chat-bot.php");
            exit();
        } else {
            echo "Error: Unable to insert data.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
