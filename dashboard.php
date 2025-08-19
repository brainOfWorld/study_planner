<?php
session_start();
require 'db.php';

if (!isset($_SESSION["student_id"])) {
    header("Location: login.php");
    exit;
}

$studentId = $_SESSION["student_id"];
$studentName = $_SESSION["student_name"];

$stmt = $pdo->prepare("SELECT * FROM tasks WHERE student_id = ? ORDER BY due_date ASC");
$stmt->execute([$studentId]);
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Dashboard</title>
<style>
    body {
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
        background: #0a0a0a;
        color: #fff;
        min-height: 100vh;
        overflow-x: hidden;
        display: flex;
        justify-content: center;
        padding: 20px;
    }

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

    .main-container {
        position: relative;
        width: 100%;
        max-width: 400px;
        background: #1c1c1e;
        border-radius: 30px;
        padding: 20px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.7);
        z-index: 1;
        overflow: hidden;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(90deg, #007bff, #00c6ff);
        color: #fff;
        padding: 15px 20px;
        border-radius: 20px;
        margin-bottom: 20px;
        font-weight: 600;
        transition: 0.3s;
    }
    .navbar:hover { transform: scale(1.01); }
    .navbar a { color: #fff; text-decoration: none; font-weight: bold; }
    .navbar a:hover { text-decoration: underline; }

    h2 { margin-bottom: 5px; font-size: 22px; }
    .welcome { margin-bottom: 20px; color: #ccc; font-size: 16px; }

    .add-task, .credits-btn {
        display: block;
        width: 100%;
        text-align: center;
        padding: 12px 0;
        border-radius: 15px;
        text-decoration: none;
        font-weight: bold;
        margin-bottom: 15px;
        transition: 0.3s;
    }

    .add-task {
        background: #28a745;
        color: #fff;
    }
    .add-task:hover {
        background: #218838;
        transform: scale(1.05);
        box-shadow: 0 6px 15px rgba(0,0,0,0.5);
    }

    .credits-btn {
        background: #007bff;
        color: #fff;
    }
    .credits-btn:hover {
        background: #0056b3;
        transform: scale(1.05);
        box-shadow: 0 6px 15px rgba(0,0,0,0.5);
    }

    .task {
        background: #2c2c2e;
        border-radius: 20px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.5);
        transition: transform 0.3s, box-shadow 0.3s;
        position: relative;
    }
    .task.completed { background: #28a745; color: #fff; }
    .task:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 10px 25px rgba(0,0,0,0.7);
    }

    .task-header {
        display: flex;
        justify-content: space-between;
        font-weight: 600;
        font-size: 16px;
        margin-bottom: 8px;
    }
    .task p { margin: 5px 0; font-size: 14px; color: #e0e0e0; }

    /* Delete button moved lower */
    .delete-btn {
        display: inline-block;
        margin-top: 10px;
        background: #dc3545;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 10px;
        font-size: 12px;
        cursor: pointer;
        transition: 0.3s;
        text-decoration: none;
    }
    .delete-btn:hover {
        background: #c82333;
        transform: scale(1.05);
    }
</style>
</head>
<body>

<div class="main-container">
    <div class="navbar">
        <span>🌟 Study Planner</span>
        <a href="logout.php">Logout</a>
    </div>

    <h2>Welcome, <?php echo htmlspecialchars($studentName); ?> 👋</h2>
    <p class="welcome">Here is your study plan:</p>

    <a href="add_task.php" class="add-task">➕ Add New Task</a>
    <a href="credit.php" class="credits-btn">📜 Project Credits</a>

    <?php if (!empty($tasks)) : ?>
        <?php foreach ($tasks as $task) : ?>
            <div class="task <?php echo $task['status'] === 'Completed' ? 'completed' : ''; ?>">
                <div class="task-header">
                    <span><?php echo htmlspecialchars($task['subject']); ?></span>
                    <span><?php echo htmlspecialchars($task['due_date']); ?></span>
                </div>
                <p><?php echo htmlspecialchars($task['description']); ?></p>
                <p>Status: <?php echo $task['status']; ?></p>
                <a class="delete-btn" href="delete_task.php?id=<?php echo $task['id']; ?>" onclick="return confirm('Are you sure you want to delete this task?');">Delete</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No tasks found. Click "Add New Task" to create your first study plan.</p>
    <?php endif; ?>
</div>

<script>
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
