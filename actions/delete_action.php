<?php

require_once("../database/db_connection.php");

if ($_SERVER["REQUEST_METHOD"] === $_POST && ($_POST["action"] ?? '') === "delete") {

  $id = $_POST["id"] ?? null;

  if ($id) {
    $stmt = $conn->prepare("
            DELETE FROM events
            WHERE id =?
        ");

    $stmt->bind_param("i", $id);

    $stmt->execute();

    $stmt->close();

    header("Location: " . $_SERVER["PHP_SELF"] . "?success=3");
  } else {
    header("Location: " . $_SERVER["PHP_SELF"] . "?error=3");
    exit;
  }
}