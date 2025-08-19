<?php
// add_task.php
require 'db.php';
session_start();

// Redirect if not logged in
if (!isset($_SESSION["student_id"])) {
    header("Location: login.php");
    exit;
}

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $subject = trim($_POST["subject"]);
    $description = trim($_POST["description"]);
    $due_date = trim($_POST["due_date"]);
    $student_id = $_SESSION["student_id"];

    if (empty($subject) || empty($due_date)) {
        $errors[] = "Subject and due date are required.";
    }

    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO tasks (student_id, subject, description, due_date) VALUES (?, ?, ?, ?)");
        $stmt->execute([$student_id, $subject, $description, $due_date]);
        $success = "Study plan added successfully!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Study Plan</title>
<style>
    body {
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
        background: #0a0a0a;
        color: #fff;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        padding: 20px;
    }

    /* Stars background */
    .star {
        position: absolute;
        width: 2px;
        height: 2px;
        background: white;
        border-radius: 50%;
        opacity: 0.8;
        animation: twinkle 2s infinite alternate;
    }
    @keyframes twinkle {
        0% { opacity: 0.2; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.5); }
        100% { opacity: 0.2; transform: scale(1); }
    }

    /* Main container like iPhone UI */
    .main-container {
        position: relative;
        width: 100%;
        max-width: 400px;
        background: #1c1c1e;
        border-radius: 30px;
        padding: 25px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.7);
        z-index: 1;
    }

    h2 { margin-bottom: 10px; font-size: 22px; text-align: center; }
    form label { display: block; margin-top: 12px; font-weight: 500; }
    input, textarea {
        width: 100%;
        padding: 12px;
        margin-top: 5px;
        border-radius: 12px;
        border: none;
        background: #2c2c2e;
        color: #fff;
        font-size: 14px;
        resize: none;
    }
    input:focus, textarea:focus { outline: 2px solid #007bff; }

    button {
        margin-top: 20px;
        background: #28a745;
        color: #fff;
        padding: 12px 0;
        border-radius: 15px;
        border: none;
        width: 100%;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover { background: #218838; transform: scale(1.03); }

    .error, .success {
        border-radius: 12px;
        padding: 10px;
        margin-bottom: 15px;
        font-size: 14px;
    }
    .error { background: #f8d7da; color: #721c24; }
    .success { background: #d4edda; color: #155724; }

    a { color: #00c6ff; text-decoration: none; display: block; text-align: center; margin-top: 15px; }
    a:hover { text-decoration: underline; }
</style>
</head>
<body>
<div class="main-container">
    <h2>Add Study Plan</h2>

    <?php if (!empty($errors)) { ?>
        <div class="error">
            <?php foreach ($errors as $error) echo "<p>$error</p>"; ?>
        </div>
    <?php } ?>

    <?php if (!empty($success)) { ?>
        <div class="success"><?= $success ?></div>
    <?php } ?>

    <form method="POST">
        <label>Subject</label>
        <input type="text" name="subject" required>

        <label>Description</label>
        <textarea name="description" rows="3"></textarea>

        <label>Due Date</label>
        <input type="date" name="due_date" required>

        <button type="submit">Save Study Plan</button>
    </form>

    <a href="dashboard.php">⬅ Back to Dashboard</a>
</div>

<script>
    // Generate stars all around
    const numStars = 120;
    for (let i = 0; i < numStars; i++) {
        const star = document.createElement('div');
        star.className = 'star';
        star.style.top = Math.random() * window.innerHeight + 'px';
        star.style.left = Math.random() * window.innerWidth + 'px';
        star.style.width = Math.random() * 3 + 1 + 'px';
        star.style.height = star.style.width;
        star.style.animationDuration = (Math.random() * 2 + 1) + 's';
        document.body.appendChild(star);
    }
</script>
</body>
</html>
