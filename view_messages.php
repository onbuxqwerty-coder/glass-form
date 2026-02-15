<?php
require_once 'config.php';

try {
    $conn = getConnection();
    $sql = "SELECT * FROM messages ORDER BY created_at DESC";
    $result = $conn->query($sql);
}
catch (Exception $e) {
    $error = "Error fetching messages: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Messages - VIST</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        /* Override specific styles for the view page if needed */
        .contact-card {
            max-width: 100%; 
        }
    </style>
</head>
<body>
    <div class="background">
        <div class="circuit-lines"></div>
    </div>

    <div class="container">
        <div class="contact-card">
            <div class="card-corner top-left"></div>
            <div class="card-corner top-right"></div>
            <div class="card-corner bottom-left"></div>
            <div class="card-corner bottom-right"></div>

            <h1 class="title">INCOMING TRANSMISSIONS</h1>

            <div class="subtitle">
                <h2>Message Log</h2>
                <p>Total: <?php echo isset($result) ? $result->num_rows : 0; ?></p>
            </div>

            <?php if (isset($error)): ?>
                <div class="form-message error" style="display:block; margin-bottom: 20px;">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php
endif; ?>

            <div class="message-list">
                <?php if (isset($result) && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <div class="message-item">
                            <div class="message-header">
                                <span class="sender-name"><?php echo htmlspecialchars($row['name']); ?></span>
                                <span class="message-date"><?php echo date('Y-m-d H:i', strtotime($row['created_at'])); ?></span>
                            </div>
                            <div class="message-meta">
                                <span class="meta-item">TYPE: DIRECT_MESSAGE</span>
                                <span class="meta-item">EMAIL: <?php echo htmlspecialchars($row['email']); ?></span>
                                <?php if (!empty($row['phone'])): ?>
                                    <span class="meta-item">PHONE: <?php echo htmlspecialchars($row['phone']); ?></span>
                                <?php
        endif; ?>
                            </div>
                            <div class="message-content"><?php echo nl2br(htmlspecialchars($row['message'])); ?></div>
                        </div>
                    <?php
    endwhile; ?>
                <?php
else: ?>
                    <div class="no-messages">
                        <p>No transmissions received.</p>
                    </div>
                <?php
endif; ?>
            </div>
            
            <div style="margin-top: 20px; text-align: center;">
                <a href="index.html" class="submit-btn" style="text-decoration: none; display: inline-block; width: auto;">
                    <span>RETURN TO COMMS</span>
                </a>
            </div>
        </div>
    </div>
</body>
</html>
<?php
if (isset($conn)) {
    $conn->close();
}
?>
