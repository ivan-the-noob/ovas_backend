<?php
require '../../../../../db.php';

$search = $_POST['search'] ?? '';


$query = "SELECT * FROM pos_records WHERE owner_name LIKE ? ORDER BY id ASC";
$stmt = $conn->prepare($query);
$stmt->execute(['%' . $search . '%']);
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($records)) {
    foreach ($records as $record):
        $services = json_decode($record['services'], true);
        $costs = json_decode($record['cost'], true);
        $medications = json_decode($record['medication'], true);
        $supplies = json_decode($record['supplies'], true);
        $total = !empty($record['total']) && is_numeric($record['total']) ? number_format($record['total'], 2) : '0.00';
    ?>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Thank you, <span class="fw-bold"><?php echo htmlspecialchars($record['owner_name']); ?>.</span></h5>
                    
                    <!-- Services Section -->
                    <div class="mb-3">
                        <label for="service" class="form-label fw-bold">Services:</label>
                        <?php if (is_array($services) && is_array($costs)): ?>
                            <?php foreach ($services as $index => $service): ?>
                                <div class="d-flex justify-content-between">
                                    <span id="service"><?php echo htmlspecialchars($service); ?></span>
                                    <span>₱ <?php echo isset($costs[$index]) ? number_format((float)$costs[$index], 2) : '0.00'; ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Medications Section -->
                    <?php if (!empty($medications)): ?>
                    <div class="mb-3">
                        <label for="medication" class="form-label fw-bold">Add Medication or Supplies:</label>
                        <?php foreach ($medications as $medication): ?>
                        <div class="d-flex justify-content-between">
                            <span id="medication"><?php echo htmlspecialchars($medication); ?></span>
                            <span>₱ 25.00</span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Supplies Section -->
                    <?php if (!empty($supplies)): ?>
                    <div class="mb-3">
                        <label for="supplies" class="form-label fw-bold">Supplies:</label>
                        <?php foreach ($supplies as $supply): ?>
                        <div class="d-flex justify-content-between">
                            <span id="supplies"><?php echo htmlspecialchars($supply); ?></span>
                            <span>₱ 299.00</span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>

                    <!-- Total Section -->
                    <div class="d-flex justify-content-between fw-bold">
                        <span>TOTAL:</span>
                        <span>₱ <?php echo $total; ?></span>
                    </div>
                    
                    <!-- Buttons Section -->
                    <div class="buttons d-flex justify-content-center gap-2">
                        <button onclick="printCard(this)">Print</button>
                        <button class="paid">Paid</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; 
} else {
    echo '<p>No transactions found.</p>';
}
?>
