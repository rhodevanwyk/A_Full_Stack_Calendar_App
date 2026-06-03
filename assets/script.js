const cal_el = document.getElementById("calendar");
const month_el = document.getElementById("month_year");
const modal_el = document.getElementById("event_modal");
let current_date = new Date();

function render_calendar(date = new Date()) {
  if (!cal_el || !month_el) {
    return;
  }

  cal_el.innerHTML = "";
  const year = date.getFullYear();
  const month = date.getMonth();
  const today = new Date();
  const total_days = new Date(year, month + 1, 0).getDate();
  const first_day_of_month = new Date(year, month, 1).getDay();

  const month_label = date.toLocaleDateString("en-US", {
    month: "long",
    year: "numeric"
  });
  month_el.innerHTML = `<i class="fa-solid fa-calendar-day text-primary-content"></i> ${month_label}`;

  const week_days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
  week_days.forEach(day => {
    const day_el = document.createElement("div");
    day_el.className = "day_name text-center font-bold mb-2 max-md:hidden";
    day_el.textContent = day;
    cal_el.appendChild(day_el);
  });

  for (let i = 0; i < first_day_of_month; i++) {
    const spacer = document.createElement("div");
    spacer.className = "calendar_spacer max-md:hidden";
    cal_el.appendChild(spacer);
  }

  for (let day = 1; day <= total_days; day++) {
    const date_string = `${year}-${String(month + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}`;

    const cell = document.createElement("div");
    cell.className =
      "day bg-base-100 text-base-content rounded-box min-h-40 p-6 flex flex-col gap-2 relative cursor-pointer";

    if (
      day === today.getDate() &&
      month === today.getMonth() &&
      year === today.getFullYear()
    ) {
      cell.classList.add("today", "border-b-4", "border-primary");
    }

    const date_el = document.createElement("div");
    date_el.className = "date_number font-bold text-left";
    const weekday = new Date(year, month, day).toLocaleDateString("en-US", { weekday: "long" });
    date_el.innerHTML =
      `<span class="md:hidden">${weekday}, </span><span>${day}</span>`;
    cell.appendChild(date_el);

    const events_today = events.filter(e => e.date === date_string);

    const event_box = document.createElement("div");
    event_box.className = "events flex flex-col gap-2";

    events_today.forEach(event => {
      const ev = document.createElement("div");
      ev.className =
        "event border-2 border-secondary rounded-box p-2 cursor-pointer hover:bg-secondary/30 flex flex-col items-start";

      const title_el = document.createElement("div");
      title_el.className = "title font-extrabold text-sm text-left";
      title_el.textContent = event.title;

      const description_el = document.createElement("div");
      description_el.className = "description";
      description_el.textContent = event.description;

      const time_el = document.createElement("div");
      time_el.className = "time text-xs text-left";
      time_el.textContent = format_event_time(event);

      ev.appendChild(title_el);
      ev.appendChild(description_el);
      ev.appendChild(time_el);
      event_box.appendChild(ev);
    });

    const overlay = document.createElement("div");
    overlay.className = "day_overlay";

    const add_btn = document.createElement("button");
    add_btn.className = "btn btn-primary btn-sm font-extrabold overlay_add_btn";
    add_btn.textContent = "Add";
    add_btn.onclick = e => {
      e.stopPropagation();
      open_modal_for_add(date_string);
    };
    overlay.appendChild(add_btn);

    if (events_today.length > 0) {
      const edit_btn = document.createElement("button");
      edit_btn.className = "btn btn-secondary btn-sm font-extrabold overlay_edit_btn";
      edit_btn.textContent = "Edit";
      edit_btn.onclick = e => {
        e.stopPropagation();
        open_modal_for_edit(events_today);
      };
      overlay.appendChild(edit_btn);
    }

    cell.appendChild(overlay);
    cell.appendChild(event_box);
    cal_el.appendChild(cell);
  }
}

function open_modal_for_add(date_string) {
  document.getElementById("form_action").value = "add";
  document.getElementById("event_id").value = "";
  document.getElementById("delete_event_id").value = "";
  document.getElementById("title").value = "";
  document.getElementById("description").value = "";
  document.getElementById("start_date").value = date_string;
  document.getElementById("end_date").value = date_string;
  document.getElementById("start_time").value = "09:00";
  document.getElementById("end_time").value = "10:00";

  const selector = document.getElementById("event_selector");
  const wrapper = document.getElementById("event_selector_wrapper");

  if (selector && wrapper) {
    selector.innerHTML = "";
    wrapper.classList.add("hidden");
    wrapper.classList.remove("block");
  }

  modal_el?.showModal();
}

function open_modal_for_edit(events_on_date) {
  document.getElementById("form_action").value = "edit";
  modal_el?.showModal();

  const selector = document.getElementById("event_selector");
  const wrapper = document.getElementById("event_selector_wrapper");
  selector.innerHTML = "<option disabled selected>Choose Event...</option>";

  events_on_date.forEach(e => {
    const option = document.createElement("option");
    option.value = JSON.stringify(e);
    option.textContent = `${e.title} (${e.start_date} > ${e.end_date})`;
    selector.appendChild(option);
  });

  if (events_on_date.length > 1) {
    wrapper.classList.remove("hidden");
    wrapper.classList.add("block");
  } else {
    wrapper.classList.add("hidden");
    wrapper.classList.remove("block");
  }

  handle_event_selection(JSON.stringify(events_on_date[0]));
}

function handle_event_selection(event_JSON) {
  const event = JSON.parse(event_JSON);

  document.getElementById("event_id").value = event.id;
  document.getElementById("delete_event_id").value = event.id;

  document.getElementById("title").value = event.title || "";
  document.getElementById("description").value = event.description || "";
  document.getElementById("start_date").value = event.start_date || "";
  document.getElementById("end_date").value = event.end_date || "";
  document.getElementById("start_time").value = event.start_time || "";
  document.getElementById("end_time").value = event.end_time || "";
}

function close_modal() {
  modal_el?.close();
}

function change_month(offset) {
  current_date.setMonth(current_date.getMonth() + offset);
  render_calendar(current_date);
}

function format_event_time(event) {
  if (!event.start_time && !event.end_time) {
    return "";
  }

  return `${event.start_time || ""} - ${event.end_time || ""}`.trim();
}

document.getElementById("prev_month")?.addEventListener("click", () => change_month(-1));
document.getElementById("next_month")?.addEventListener("click", () => change_month(1));
document.getElementById("cancel_modal")?.addEventListener("click", close_modal);
document.getElementById("event_selector")?.addEventListener("change", event => {
  handle_event_selection(event.target.value);
});

render_calendar(current_date);
