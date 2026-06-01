<?php

require_once("../database/db_connection.php");

$events_from_db = [];

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
