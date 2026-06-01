<?php

require_once("../database/db_connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["action"] ?? "") === "add") {

  $title = trim($_POST["title"] ?? "");
  $description = trim($_POST["description"] ?? "");
  $start_date = $_POST["start_date"];
  $end_date = $_POST["end_date"];
  $start_time = $_POST["start_time"] ?? "";
  $end_time = $_POST["end_time"] ?? "";

  if ($title && $description && $start_date && $end_date) {
    $stmt = $conn->prepare("
            INSERT INTO events (title, description, start_date, end_date, start_time, end_time)
            VALUES (?, ?, ?, ?, ?, ?)
        ");

    $stmt->bind_param("ssssss", $title, $description, $start_date, $end_date, $start_time, $end_time);

    $stmt->execute();

    $stmt->close();

    header("Location: " . $_SERVER["PHP_SELF"] . "?success=1");
    exit;
  } else {
    header("Location: " . $_SERVER["PHP_SELF"] . "?error=1");
    exit;
  }
}
