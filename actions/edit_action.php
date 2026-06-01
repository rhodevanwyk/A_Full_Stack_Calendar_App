<?php

require_once("../database/db_connection.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && ($_POST["action"] ?? "") === "edit") {
  $id = $_POST["id"] ?? null;
  $title = trim($_POST("title") ?? "");
  $description = trim($_POST["description"] ?? "");
  $start_date = $_POST["start_date"];
  $end_date = $_POST["end_date"];

  if ($id && $title && $description && $start_date && $end_date) {
    $stmt = $conn->prepare("
            UPDATE events
            SET title = ?, description = ?, start_date = ?, end_date = ?
            WHERE id = ?
        ");

    $stmt->bind_param("ssssi", $title, $description, $start_date, $end_date, $id);

    $stmt->execute();

    $stmt->close();

    header("Location: " . $_SERVER["PHP_SELF"] . "?success=2");
  } else {
    header("Location: " . $_SERVER["PHP_SELF"] . "?error=2");
    exit;
  }
}