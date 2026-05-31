<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendar</title>
  <meta name="description"
    content="A Calendar App created by Rhode Van Wyk, using Vanilla code, PHP, MySQL, HTML, CSS, and JS.">
  <link rel="icon" type="image/png" href="#">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@7.2.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700;800&display=swap">
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <header>
    <h1>Rhode's Calendar</h1>
  </header>

  <!-- Calendar Section -->
  <div class="calendar">
    <div class="nav_btn_container">
      <button class="nav_btn"><i class="fa-solid fa-angles-left"></i></button>
      <h2 id="month_year"></h2>
      <button class="nav_btn"><i class="fa-solid fa-angles-right"></i></button>
    </div>

    <div class="calendar_grid" id="calendar"></div>
  </div>

  <!-- Modal Popup -->
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

      <!-- Add Form -->
      <form method="POST" id="event_form">
        <input type="hidden" name="action" value="add" id="form_action">
        <input type="hidden" name="event_id" id="event_id">

        <label for="event_title">Title</label>
        <input type="text" name="event_title" id="event_title" required>

        <label for="event_description">Description</label>
        <input type="text" name="event_description" id="event_description" required>

        <label for="start_date">Start Date</label>
        <input type="date" name="start_date" id="start_date" required>

        <label for="end_date">End Date</label>
        <input type="date" name="end_date" id="end_date" required>

        <button type="submit" class="submit_btn">SAVE</button>
      </form>

      <!-- Delete Form -->
      <form method="POST" onsubmit="return confirm('Are You Sure You Want To Delete This Event?')">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="event_id" id="delete_event_id">
        <button type="submit" class="submit_btn">DELETE</button>
      </form>

      <!-- Cancel -->
      <button type="button" class="submit_btn">CANCEL</button>

    </div>

  </div>

  <script src="script.js"></script>
</body>

</html>