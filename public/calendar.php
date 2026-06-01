<?php

require_once ("../actions/add_action.php");
require_once ("../actions/edit_action.php");
require_once ("../actions/delete_action.php");
require_once ("../actions/calendar_data.php");

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendar</title>
  <meta name="description"
    content="A Calendar App created by Rhode Van Wyk, using Vanilla code, PHP, MySQL, HTML, CSS, and JS.">
  <link rel="icon" type="image/png" href="../assets/images/favicon.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.2.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;800&display=swap">
  <link rel="stylesheet" href="../assets/style.css">
</head>

<body>

  <div class="calendar">
    <div class="nav_btn_container">
      <button class="nav_btn" id="prev_month" type="button"><i class="fa-solid fa-angles-left"></i></button>
      <h2 id="month_year"><i class="fa-solid fa-calendar-day"></i>
        <?php
        $month_year = new DateTime();
        echo $month_year->format('F Y');
        ?>
      </h2>
      <button class="nav_btn" id="next_month" type="button"><i class="fa-solid fa-angles-right"></i></button>
    </div>

    <div class="calendar_grid" id="calendar"></div>
  </div>

  <div class="modal" id="event_modal">

    <div class="modal_content">

      <div id="event_selector_wrapper">
        <label for="event_selector">
          <strong>Select Event:</strong>
        </label>
        <select id="event_selector">
          <option disabled selected>Choose Event...</option>
        </select>
      </div>

      <form method="POST" id="event_form">
        <input type="hidden" name="action" value="add" id="form_action">
        <input type="hidden" name="event_id" id="event_id">

        <label for="title">Title</label>
        <input type="text" name="title" id="title" required>

        <label for="description">Description</label>
        <input type="text" name="description" id="description" required>

        <label for="start_date">Start Date</label>
        <input type="date" name="start_date" id="start_date" required>

        <label for="end_date">End Date</label>
        <input type="date" name="end_date" id="end_date" required>

        <label for="start_time">Start Time</label>
        <input type="time" name="start_time" id="start_time">

        <label for="end_time">End Time</label>
        <input type="time" name="end_time" id="end_time">

        <button type="submit" class="submit_btn">Save</button>
      </form>

      <form method="POST" onsubmit="return confirm('Are You Sure You Want To Delete This Event?')">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="event_id" id="delete_event_id">
        <div class="can_del_btns">
          <button type="submit" class="submit_btn">Delete</button>
          <button type="button" class="submit_btn" id="cancel_modal">Cancel</button>
        </div>
      </form>


    </div>

  </div>

  <script>
    const events = <?= json_encode($events_from_db ?? ($events ?? []), JSON_UNESCAPED_UNICODE); ?>;
  </script>
  <script src="../assets/script.js"></script>

</body>

</html>
