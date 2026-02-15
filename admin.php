<?php
require_once 'config.php';

$conn = getConnection();
$result = $conn->query("SELECT * FROM messages ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Messages</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Rajdhani:wght@400;500&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Rajdhani', sans-serif;
            background: #0a0e17;
            color: #c0d0e0;
            min-height: 100vh;
            padding: 30px;
        }
        h1 {
            font-family: 'Orbitron', sans-serif;
            color: #00d4ff;
            text-shadow: 0 0 20px rgba(0, 200, 255, 0.5);
            margin-bottom: 30px;
        }
        .message-card {
            background: rgba(10, 30, 60, 0.8);
            border: 1px solid rgba(0, 150, 200, 0.3);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 15px;
        }
        .message-card h3 {
            color: #00d4ff;
            margin-bottom: 10px;
        }
        .message-card p { margin-bottom: 8px; }
        .message-card .meta {
            color: #607080;
            font-size: 0.85rem;
        }
        .message-content {
            background: rgba(0, 40, 80, 0.3);
            padding: 15px;
            border-radius: 4px;
            margin-top: 10px;
        }
        .back-link {
            display: inline-block;
            color: #00d4ff;
            text-decoration: none;
            margin-bottom: 20px;
        }
        .back-link:hover { text-decoration: underline; }
        .no-messages {
            text-align: center;
            color: #607080;
            padding: 40px;
        }
    </style>
</head>
<body>
    <a href="index.html" class="back-link">&larr; Back to Contact Form</a>
    <h1>— MESSAGES_</h1>

    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="message-card">
                <h3><?php echo htmlspecialchars($row['name']); ?></h3>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></p>
                <?php if (!empty($row['phone'])): ?>
                    <p><strong>Phone:</strong> <?php echo htmlspecialchars($row['phone']); ?></p>
                <?php endif; ?>
                <p class="meta">Received: <?php echo date('M d, Y H:i', strtotime($row['created_at'])); ?></p>
                <div class="message-content">
                    <?php echo nl2br(htmlspecialchars($row['message'])); ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="no-messages">No messages yet.</div>
    <?php endif; ?>

    <?php $conn->close(); ?>
</body>
</html>
