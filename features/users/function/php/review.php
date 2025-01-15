<?php
require 'db.php'; 

$stmt = $conn->prepare("SELECT name, profile_picture, comment, rating, image FROM reviews WHERE view = 1 ORDER BY created_at DESC");
$stmt->execute();
$reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($reviews) > 0) {
    $chunks = array_chunk($reviews, 4); 
    ?>
    <div id="reviewCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($chunks as $chunkIndex => $chunk) { ?>
                <div class="carousel-item <?php echo $chunkIndex === 0 ? 'active' : ''; ?>">
                    <div class="row">
                        <!-- First Row: Top 2 Reviews -->
                        <?php if (isset($chunk[0])) { ?>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="testimonial-card-custom p-3 review-box">
                                    <div class="d-flex align-items-center">
                                        <img src="assets/img/profile/<?php echo isset($chunk[0]['profile_picture']) ? htmlspecialchars($chunk[0]['profile_picture'], ENT_QUOTES, 'UTF-8') : 'customer.jfif'; ?>" alt="<?php echo htmlspecialchars($chunk[0]['name'], ENT_QUOTES, 'UTF-8'); ?>" width="50" height="50">
                                        <div class="ml-3 d-flex flex-column gap-2 align-items-center justify-content-center">
                                         
                                            <p class="testimonial-rating mb-0 mt-0">
                                                <?php for ($i = 1; $i <= 5; $i++) {
                                                    echo $i <= $chunk[0]['rating'] ? '<i class="fa fa-star" style="color: gold;"></i>' : '<i class="fa fa-star-o"></i>';
                                                } ?>
                                            </p>
                                            <p class="testimonial-title mb-0 mt-0"><?php echo htmlspecialchars($chunk[0]['name'], ENT_QUOTES, 'UTF-8'); ?></p>
                                        </div>
                                    </div>
                                    
                                    <p class=""><?php echo nl2br(htmlspecialchars($chunk[0]['comment'], ENT_QUOTES, 'UTF-8')); ?></p>
                                    <?php if (isset($chunk[0]['image']) && $chunk[0]['image']) { ?>
                                        <img src="assets/img/review/<?php echo htmlspecialchars($chunk[0]['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Review Image" class="img-fluid">
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($chunk[1])) { ?>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="testimonial-card-custom p-3 review-box">
                                    <div class="d-flex align-items-center">
                                        <img src="assets/img/profile/<?php echo isset($chunk[1]['profile_picture']) ? htmlspecialchars($chunk[1]['profile_picture'], ENT_QUOTES, 'UTF-8') : 'customer.jfif'; ?>" alt="<?php echo htmlspecialchars($chunk[1]['name'], ENT_QUOTES, 'UTF-8'); ?>" width="50" height="50">
                                        <div class="ml-3 d-flex flex-column gap-2 align-items-center justify-content-center">
                                           
                                            <p class="testimonial-rating mb-0 mt-0">
                                                <?php for ($i = 1; $i <= 5; $i++) {
                                                    echo $i <= $chunk[1]['rating'] ? '<i class="fa fa-star" style="color: gold;"></i>' : '<i class="fa fa-star-o"></i>';
                                                } ?>
                                            </p>
                                            <p class="testimonial-title mb-0 mt-0"><?php echo htmlspecialchars($chunk[1]['name'], ENT_QUOTES, 'UTF-8'); ?></p>
                                        </div>
                                    </div>
                                    <p class=""><?php echo nl2br(htmlspecialchars($chunk[1]['comment'], ENT_QUOTES, 'UTF-8')); ?></p>
                                    <?php if (isset($chunk[1]['image']) && $chunk[1]['image']) { ?>
                                        <img src="assets/img/review/<?php echo htmlspecialchars($chunk[1]['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Review Image" class="img-fluid">
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="row">
                        <!-- Second Row: Bottom 2 Reviews -->
                        <?php if (isset($chunk[2])) { ?>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="testimonial-card-custom p-3 review-box">
                                    <div class="d-flex align-items-center">
                                        <img src="assets/img/profile/<?php echo isset($chunk[2]['profile_picture']) ? htmlspecialchars($chunk[2]['profile_picture'], ENT_QUOTES, 'UTF-8') : 'customer.jfif'; ?>" alt="<?php echo htmlspecialchars($chunk[2]['name'], ENT_QUOTES, 'UTF-8'); ?>" width="50" height="50">
                                        <div class="ml-3 d-flex flex-column gap-2 align-items-center justify-content-center">
                                            <p class="testimonial-title mb-0 mt-0"><?php echo htmlspecialchars($chunk[2]['name'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            <p class="testimonial-rating mb-0 mt-0">
                                                <?php for ($i = 1; $i <= 5; $i++) {
                                                    echo $i <= $chunk[2]['rating'] ? '<i class="fa fa-star" style="color: gold;"></i>' : '<i class="fa fa-star-o"></i>';
                                                } ?>
                                            </p>
                                        </div>
                                    </div>
                                    <p class=""><?php echo nl2br(htmlspecialchars($chunk[2]['comment'], ENT_QUOTES, 'UTF-8')); ?></p>
                                    <?php if (isset($chunk[2]['image']) && $chunk[2]['image']) { ?>
                                        <img src="assets/img/review/<?php echo htmlspecialchars($chunk[2]['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Review Image" class="img-fluid ">
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                        <?php if (isset($chunk[3])) { ?>
                            <div class="col-lg-6 col-md-6 col-sm-12 mb-3">
                                <div class="testimonial-card-custom p-3 review-box">
                                    <div class="d-flex align-items-center">
                                        <img src="assets/img/profile/<?php echo isset($chunk[3]['profile_picture']) ? htmlspecialchars($chunk[3]['profile_picture'], ENT_QUOTES, 'UTF-8') : 'customer.jfif'; ?>" alt="<?php echo htmlspecialchars($chunk[3]['name'], ENT_QUOTES, 'UTF-8'); ?>" width="50" height="50">
                                        <div class="ml-3 d-flex gap-2 align-items-center justify-content-center">
                                            <p class="testimonial-title mb-0 mt-0"><?php echo htmlspecialchars($chunk[3]['name'], ENT_QUOTES, 'UTF-8'); ?></p>
                                            <p class="testimonial-rating mb-0 mt-0">
                                                <?php for ($i = 1; $i <= 5; $i++) {
                                                    echo $i <= $chunk[3]['rating'] ? '<i class="fa fa-star" style="color: gold;"></i>' : '<i class="fa fa-star-o"></i>';
                                                } ?>
                                            </p>
                                        </div>
                                    </div>
                                    <p class=""><?php echo nl2br(htmlspecialchars($chunk[3]['comment'], ENT_QUOTES, 'UTF-8')); ?></p>
                                    <?php if (isset($chunk[3]['image']) && $chunk[3]['image']) { ?>
                                        <img src="assets/img/review/<?php echo htmlspecialchars($chunk[3]['image'], ENT_QUOTES, 'UTF-8'); ?>" alt="Review Image" class="img-fluid ">
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <!-- Carousel controls -->
        <button class="carousel-control-prev" type="button" data-bs-target="#reviewCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#reviewCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <?php
} else {
    echo "<p>No reviews available.</p>";
}
?>
