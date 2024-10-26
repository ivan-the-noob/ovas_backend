<?php
require 'db.php'; 

$stmt = $conn->prepare("SELECT name, profile_picture, comment FROM reviews WHERE view = 1 ORDER BY created_at DESC LIMIT 4");
$stmt->execute();
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($reviews) > 0) {
    foreach ($reviews as $index => $review) {
        $profilePicture = $review['profile_picture'] ? 'assets/img/profile/' . htmlspecialchars($review['profile_picture'], ENT_QUOTES, 'UTF-8') : 'assets/img/customer.jfif';
        ?>
        <div class="col-lg-6 col-md-6 col-sm-12">
            <div class="testimonial-card-custom p-3 review-box" id="translate-<?php echo $index + 1; ?>">
                <div class="d-flex align-items-center">
                    <img src="<?php echo $profilePicture; ?>" alt="<?php echo htmlspecialchars($review['name'], ENT_QUOTES, 'UTF-8'); ?>" width="50" height="50">
                    <div class="ml-3">
                        <p class="testimonial-title"><?php echo htmlspecialchars($review['name'], ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>
                <p class="mt-3"><?php echo nl2br(htmlspecialchars($review['comment'], ENT_QUOTES, 'UTF-8')); ?></p>
            </div>
        </div>
        <?php
    }
} else {
   
}
?>
