<?php

require_once("../database/db_connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["action"] ?? "") === "edit") {
  $id = $_POST["event_id"] ?? null;
  $title = trim($_POST["title"] ?? "");
  $description = trim($_POST["description"] ?? "");
  $start_date = $_POST["start_date"];
  $end_date = $_POST["end_date"];
  $start_time = $_POST["start_time"] ?? "";
  $end_time = $_POST["end_time"] ?? "";

  if ($id && $title && $description && $start_date && $end_date) {
    $stmt = $conn->prepare("
            UPDATE events
            SET title = ?, description = ?, start_date = ?, end_date = ?, start_time = ?, end_time = ?
            WHERE id = ?
        ");

    $stmt->bind_param("ssssssi", $title, $description, $start_date, $end_date, $start_time, $end_time, $id);

    $stmt->execute();

    $stmt->close();

    header("Location: " . $_SERVER["PHP_SELF"] . "?success=2");
    exit;
  } else {
    header("Location: " . $_SERVER["PHP_SELF"] . "?error=2");
    exit;
  }
}
