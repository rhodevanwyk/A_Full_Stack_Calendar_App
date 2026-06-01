<?php

require_once("../database/db_connection.php");

if ($_SERVER["REQUEST_METHOD"] === $_POST && ($_POST["action"] ?? '') === "add") {

  $title = trim($_POST["title"] ?? "");
  $description = trim($_POST["description"] ?? "");
  $start_date = $_POST["start_date"];
  $end_date = $_POST["end_date"];

  if ($title && $description && $start_date && $end_date) {
    $stmt = $conn->prepare("
            INSERT INTO events (title, description, start_date, end_date)
            VALUES (?, ?, ?, ?)
        ");

    $stmt->bind_param("ssss", $title, $description, $start_date, $end_date);

    $stmt->execute();

    $stmt->close();

    header("Location: " . $_SERVER["PHP_SELF"] . "?success=1");
  } else {
    header("Location: " . $_SERVER["PHP_SELF"] . "?error=1");
    exit;
  }
}