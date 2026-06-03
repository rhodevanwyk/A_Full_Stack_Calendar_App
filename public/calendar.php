<?php

require_once("../actions/add_action.php");
require_once("../actions/edit_action.php");
require_once("../actions/delete_action.php");
require_once("../actions/calendar_data.php");

?>

<!DOCTYPE html>
<html lang="en" data-theme="pastel" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendar</title>
  <meta name="description"
    content="A Calendar App created by Rhode Van Wyk, PHP, MySQL, HTML, Daisy UI / Tailwind CSS and JS.">
  <link rel="icon" type="image/png" href="../assets/images/favicon.png">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.2.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;800&display=swap">
  <link rel="stylesheet" href="../assets/style.css">
</head>

<body class="bg-base-300 text-base-content min-h-screen p-6 md:p-12">

  <div class="calendar max-w-full rounded-box">
    <div class="nav_btn_container bg-base-100 rounded-box flex flex-wrap justify-between items-center gap-4 p-6 mb-6">
      <button class="btn btn-primary text-xl font-extrabold px-8" id="prev_month" type="button"
        aria-label="Previous month">
        <i class="fa-solid fa-angles-left"></i>
      </button>
      <h2 id="month_year" class="font-extrabold text-xl text-center flex items-center gap-2">
        <i class="fa-solid fa-calendar-day text-primary-content"></i>
        <?php
        $month_year = new DateTime();
        echo $month_year->format('F Y');
        ?>
      </h2>
      <button class="btn btn-primary text-xl font-extrabold px-8" id="next_month" type="button" aria-label="Next month">
        <i class="fa-solid fa-angles-right"></i>
      </button>
    </div>

    <div class="grid grid-cols-7 gap-2 max-md:flex max-md:flex-col max-md:gap-3" id="calendar"></div>
  </div>

  <dialog id="event_modal" class="modal">
    <div class="modal-box w-11/12 max-w-lg bg-base-100">

      <div id="event_selector_wrapper" class="hidden mb-4">
        <label class="label font-bold" for="event_selector">Select Event</label>
        <select id="event_selector" class="select w-full">
          <option disabled selected>Choose Event...</option>
        </select>
      </div>

      <form method="POST" id="event_form" class="flex flex-col gap-2">
        <input type="hidden" name="action" value="add" id="form_action">
        <input type="hidden" name="event_id" id="event_id">

        <label class="label font-semibold" for="title">Title</label>
        <input type="text" name="title" id="title" class="input w-full" required>

        <label class="label font-semibold" for="description">Description</label>
        <input type="text" name="description" id="description" class="input w-full" required>

        <label class="label font-semibold" for="start_date">Start Date</label>
        <input type="date" name="start_date" id="start_date" class="input w-full" required>

        <label class="label font-semibold" for="end_date">End Date</label>
        <input type="date" name="end_date" id="end_date" class="input w-full" required>

        <label class="label font-semibold" for="start_time">Start Time</label>
        <input type="time" name="start_time" id="start_time" class="input w-full">

        <label class="label font-semibold" for="end_time">End Time</label>
        <input type="time" name="end_time" id="end_time" class="input input-bordered w-full mb-2">

        <button type="submit" class="btn btn-primary font-extrabold w-full mt-4">Save</button>
      </form>

      <form method="POST" class="mt-2" onsubmit="return confirm('Are You Sure You Want To Delete This Event?')">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="event_id" id="delete_event_id">
        <div class="flex flex-wrap gap-2">
          <button type="submit" class="btn btn-error w-full">Delete</button>
          <button type="button" class="btn btn-neutral w-full" id="cancel_modal">Cancel</button>
        </div>
      </form>

    </div>
    <form method="dialog" class="modal-backdrop">
      <button type="submit" aria-label="Close modal">close</button>
    </form>
  </dialog>

  <script>
    const events = <?= json_encode($events_from_db ?? ($events ?? []), JSON_UNESCAPED_UNICODE); ?>;
  </script>
  <script src="../assets/script.js"></script>

</body>

</html>