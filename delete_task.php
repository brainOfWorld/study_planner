<?php
// delete_task.php
session_start();
require 'db.php';

// Redirect if not logged in
if (!isset($_SESSION["student_id"])) {
    header("Location: login.php");
    exit;
}

$studentId = $_SESSION["student_id"];

if (isset($_GET['id'])) {
    $taskId = intval($_GET['id']);

    // Delete task only if it belongs to the logged-in student
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ? AND student_id = ?");
    $stmt->execute([$taskId, $studentId]);
}

// Redirect back to dashboard
header("Location: dashboard.php");
exit;
