<?php
require 'db.php';
session_start();

$errors = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        $errors[] = "Both fields are required.";
    } else {
        $stmt = $pdo->prepare("SELECT * FROM students WHERE email = ?");
        $stmt->execute([$email]);
        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($student && password_verify($password, $student["password_hash"])) {
            $_SESSION["student_id"] = $student["id"];
            $_SESSION["student_name"] = $student["name"];
            header("Location: dashboard.php");
            exit;
        } else {
            $errors[] = "Invalid email or password.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Login</title>
<style>
    body {
        margin: 0;
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
        background: #0a0a0a;
        color: #fff;
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
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
        padding: 30px;
        box-shadow: 0 8px 30px rgba(0,0,0,0.7);
        z-index: 1;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .main-container:hover { transform: scale(1.01); box-shadow: 0 10px 35px rgba(0,0,0,0.8); }

    h2 { margin-bottom: 15px; font-size: 24px; text-align: center; }
    form label { display: block; margin-top: 12px; font-weight: 500; }
    input {
        width: 100%;
        padding: 12px;
        margin-top: 5px;
        border-radius: 12px;
        border: none;
        background: #2c2c2e;
        color: #fff;
        font-size: 14px;
        transition: 0.3s;
    }
    input:focus { outline: 2px solid #007bff; transform: scale(1.02); }

    button {
        margin-top: 20px;
        background: #007bff;
        color: #fff;
        padding: 12px 0;
        border-radius: 15px;
        border: none;
        width: 100%;
        font-weight: bold;
        cursor: pointer;
        transition: 0.3s;
    }
    button:hover { background: #0056b3; transform: scale(1.05); }

    .error {
        border-radius: 12px;
        padding: 10px;
        margin-bottom: 15px;
        font-size: 14px;
        background: #f8d7da;
        color: #721c24;
        transition: transform 0.3s;
    }
    .error:hover { transform: scale(1.01); }

    a {
        color: #00c6ff;
        text-decoration: none;
        display: block;
        text-align: center;
        margin-top: 15px;
        transition: 0.3s;
    }
    a:hover { text-decoration: underline; transform: scale(1.02); }
</style>
</head>
<body>
<div class="main-container">
    <h2>Student Login</h2>

    <?php if (!empty($errors)) { ?>
        <div class="error">
            <?php foreach ($errors as $error) echo "<p>$error</p>"; ?>
        </div>
    <?php } ?>

    <form method="POST">
        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? <a href="register.php">Register</a></p>
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
