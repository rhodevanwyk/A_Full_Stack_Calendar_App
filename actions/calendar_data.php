<?php

require_once("../database/db_connection.php");

$success_msg = "";
$error_msg = "";
$events_from_db = [];

if (isset($_GET["success"])) {
  $success_msg = match ($_GET["success"]) {
    "1" => "Your Event Was Deleted Succesfully!",
    "2" => "Your Event Was Updated Succesfully!",
    "3" => "Your Event Was Deleted Succesfully!",
    default => ""
  };
}

if (isset($_GET["error"])) {
  $error_msg = match ($_GET["error"]) {
    "1" => "ERROR: Your Event Was NOT Added",
    "2" => "ERROR: Your Event Was NOT Updated",
    "3" => "ERROR: Your Event Was NOT Deleted",
    default => ""
  };
}

$result = $conn->query("
    SELECT * FROM events
");

if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $start_date = new DateTime($row["start_date"]);
    $end_date = new DateTime($row["end_date"]);

    while ($start_date <= $end_date) {
      $events_from_db[] = [
        "id" => $row["id"],
        "title" => $row["title"],
        "description" => $row["description"],
        "date" => $start_date->format("Y-m-d"),
        "start_date" => $row["start_date"],
        "end_date" => $row["end_date"],
        "start_time" => $row["start_time"],
        "end_time" => $row["end_time"]
      ];

      $start_date->modify("+1 day");
    }
  }
}

$conn->close();
