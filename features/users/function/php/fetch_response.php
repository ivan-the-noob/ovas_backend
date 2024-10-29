<?php
require '../../../../db.php';

if (isset($_GET['question'])) {
    $question = $_GET['question'];

    try {
        $sql = "SELECT response FROM chat_messages WHERE question = :question LIMIT 1";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':question', $question, PDO::PARAM_STR);

        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            echo htmlspecialchars($row['response'], ENT_QUOTES, 'UTF-8');
        } else {
            echo "I'm sorry, I cannot answer that question.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
