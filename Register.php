<?php
require 'db.php';

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($name) || empty($email) || empty($password)) {
        $errors[] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if (empty($errors)) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare("INSERT INTO students (name, email, password_hash) VALUES (?, ?, ?)");
            $stmt->execute([$name, $email, $password_hash]);
            $success = "Registration successful! You can now <a href='login.php'>login</a>.";
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $errors[] = "Email already registered.";
            } else {
                $errors[] = "Error: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Registration</title>
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
    button:hover { background: #218838; transform: scale(1.05); }

    .error, .success {
        border-radius: 12px;
        padding: 10px;
        margin-bottom: 15px;
        font-size: 14px;
        transition: transform 0.3s;
    }
    .error:hover { transform: scale(1.01); }
    .success:hover { transform: scale(1.01); }

    a { color: #00c6ff; text-decoration: none; display: block; text-align: center; margin-top: 15px; transition: 0.3s; }
    a:hover { text-decoration: underline; transform: scale(1.02); }
</style>
</head>
<body>
<div class="main-container">
    <h2>Student Registration</h2>

    <?php if (!empty($errors)) { ?>
        <div class="error">
            <?php foreach ($errors as $error) echo "<p>$error</p>"; ?>
        </div>
    <?php } ?>

    <?php if (!empty($success)) { ?>
        <div class="success"><?= $success ?></div>
    <?php } ?>

    <form method="POST">
        <label>Full Name</label>
        <input type="text" name="name" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Register</button>
    </form>

    <p>Already have an account? <a href="login.php">Login</a></p>
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
