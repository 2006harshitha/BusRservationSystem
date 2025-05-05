// ---------------- Section Navigation ----------------
function showSection(sectionId) {
  document.querySelectorAll(".section").forEach((sec) => {
    sec.style.display = "none";
  });
  document.getElementById(sectionId).style.display = "block";

  if (sectionId === "dashboard") {
    fetchDashboardData();
  }
  else if (sectionId === "bookings") {
    fetchUsersData();
  }
}
function fetchUsersData() {
  fetch("get_users_data.php")
    .then((res) => res.json())
    .then((data) => {
      const container = document.getElementById("usersContainer");
      if (!data.success || !Array.isArray(data.data)) {
        container.innerHTML = "<p>Failed to load users.</p>";
        return;
      }

      const users = data.data;

      if (users.length === 0) {
        container.innerHTML = "<p>No users found.</p>";
        return;
      }

      let html = `
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Phone</th>
              <th>Password</th>
              <th>Gender</th>
              <th>Age</th>
              <th>Email</th>
            </tr>
          </thead>
          <tbody>
      `;

      users.forEach((user) => {
        html += `
          <tr>
            <td>${user.id}</td>
            <td>${user.name}</td>
            <td>${user.phone}</td>
            <td>${user.password}</td>
            <td>${user.gender}</td>
            <td>${user.age}</th>
            <td>${user.email}</th>
          </tr>
        `;
      });

      html += `</tbody></table>`;
      container.innerHTML = html;
    })
    .catch((err) => {
      console.error("Error fetching users:", err);
      document.getElementById("usersContainer").innerHTML = "<p>Error loading users.</p>";
    });
}

// ---------------- Fetch Dashboard Data ----------------
function fetchDashboardData() {
  fetch("get_dashboard_data.php")
    .then((response) => response.json())
    .then((data) => {
      const container = document.querySelector("#dashboard .showbus");
      if (!data.success || !Array.isArray(data.data)) {
        container.innerHTML = "<p>No bus data available.</p>";
        return;
      }

      const buses = data.data;
      let html = `
          <table class="dashboard-table">
            <thead>
              <tr>
                <th>Bus ID</th>
                <th>Name</th>
                <th>Origin</th>
                <th>Destination</th>
                <th>Stops</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Type</th>
                <th>Seat Type</th>
                <th>Day</th>
                <th>Seats</th>
                <th>Base Price</th>
              </tr>
            </thead>
            <tbody>
        `;

      buses.forEach((bus) => {
        html += `
            <tr>
              <td>${bus.bus_id}</td>
              <td>${bus.bus_name}</td>
              <td>${bus.origin}</td>
              <td>${bus.destination}</td>
              <td>${bus.stops.join(", ")}</td>
              <td>${bus.start_time}</td>
              <td>${bus.end_time}</td>
              <td>${bus.bus_type}</td>
              <td>${bus.seat_type}</td>
              <td>${bus.day}</td>
              <td>${bus.total_seats}</td>
              <td>${bus.base_price}</td>
            </tr>`;
      });

      html += `</tbody></table>`;
      container.innerHTML = html;
    })
    .catch((error) => {
      console.error("Error fetching dashboard data:", error);
      document.querySelector("#dashboard .showbus").innerHTML =
        "<p>Error loading bus details.</p>";
    });
}

// ---------------- Bus Management ----------------
const form = document.getElementById("busForm");

form.addEventListener("submit", function (e) {
  e.preventDefault();

  const data = {
    bus_id: document.getElementById("busId").value.trim(),
    bus_name: document.getElementById("busName").value.trim(),
    origin: document.getElementById("origin").value.trim(),
    destination: document.getElementById("destination").value.trim(),
    stops: document.getElementById("stops").value.trim(),
    start_time: document.getElementById("startTime").value.trim(),
    end_time: document.getElementById("endTime").value.trim(),
    bus_type: document.getElementById("busType").value,
    seat_type: document.getElementById("seatType").value,
    day: document.getElementById("day").value.trim(),
    total_seats: document.getElementById("totalSeats").value.trim(),
    base_price: document.getElementById("basePrice").value.trim(),
  };

  fetch("add_bus.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(data),
  })
    .then((res) => res.json())
    .then((response) => {
      if (response.success) {
        alert("Bus added successfully!");
        form.reset();
      } else {
        alert("Failed to add bus: " + response.message);
      }
    })
    .catch((error) => {
      console.error("Error:", error);
      alert("Error adding bus.");
    });
});
function attachEditDeleteHandlers(row) {
  const editBtn = row.querySelector(".edit-btn");
  const deleteBtn = row.querySelector(".delete-btn");

  editBtn.addEventListener("click", function () {
    if (editBtn.textContent === "Edit") {
      const cells = row.querySelectorAll("td");
      for (let i = 0; i < 4; i++) {
        const value = cells[i].textContent;
        if (i === 2) {
          cells[i].innerHTML = `
              <select>
                <option value="AC Seating" ${
                  value === "AC Seating" ? "selected" : ""
                }>AC Seating</option>
                <option value="Non-AC Seating" ${
                  value === "Non-AC Seating" ? "selected" : ""
                }>Non-AC Seating</option>
                <option value="AC Sleeper" ${
                  value === "AC Sleeper" ? "selected" : ""
                }>AC Sleeper</option>
                <option value="Non-AC Sleeper" ${
                  value === "Non-AC Sleeper" ? "selected" : ""
                }>Non-AC Sleeper</option>
              </select>`;
        } else {
          cells[i].innerHTML = `<input type="text" value="${value}" />`;
        }
      }
      editBtn.textContent = "Save";
      editBtn.classList.replace("edit-btn", "save-btn");
    } else {
      const inputs = row.querySelectorAll("input, select");
      const values = Array.from(inputs).map((input) => input.value.trim());
      if (values.includes("")) return alert("All fields are required!");

      row.innerHTML = `
          <td>${values[0]}</td>
          <td>${values[1]}</td>
          <td>${values[2]}</td>
          <td>${values[3]}</td>
          <td>
            <button class="edit-btn">Edit</button>
            <button class="delete-btn">Delete</button>
          </td>`;
      attachEditDeleteHandlers(row);
    }
  });

  deleteBtn.addEventListener("click", function () {
    if (confirm("Are you sure you want to delete this bus?")) {
      row.remove();
    }
  });
}

// ---------------- Booking Management ----------------
// const bookings = [
//   {
//     id: 1001,
//     passenger: "John Doe",
//     route: "City A to City B",
//     date: "2025-04-20",
//     status: "Confirmed",
//   },
//   {
//     id: 1002,
//     passenger: "Jane Smith",
//     route: "City C to City D",
//     date: "2025-04-22",
//     status: "Cancelled",
//   },
//   {
//     id: 1003,
//     passenger: "Alice Lee",
//     route: "City A to City E",
//     date: "2025-04-25",
//     status: "Confirmed",
//   },
// ];

// const tableBody = document.getElementById("bookingTableBody");
// const searchInput = document.getElementById("searchInput");
// const filterStatus = document.getElementById("filterStatus");

// function renderTable(data) {
//   tableBody.innerHTML = "";
//   data.forEach((booking) => {
//     const row = document.createElement("tr");
//     row.innerHTML = `
//         <td>${booking.id}</td>
//         <td>${booking.passenger}</td>
//         <td>${booking.route}</td>
//         <td>${booking.date}</td>
//         <td><span class="status ${booking.status}">${booking.status}</span></td>
//         <td>
//           <button class="btn view-btn" onclick="viewDetails(${
//             booking.id
//           })">View</button>
//           ${
//             booking.status === "Confirmed"
//               ? `<button class="btn cancel-btn" onclick="cancelBooking(${booking.id})">Cancel</button>`
//               : ""
//           }
//         </td>`;
//     tableBody.appendChild(row);
//   });
// }

// function viewDetails(id) {
//   const booking = bookings.find((b) => b.id === id);
//   if (!booking) return;

//   document.getElementById("detailsContent").innerHTML = `
//       Booking ID: ${booking.id}<br>
//       Passenger: ${booking.passenger}<br>
//       Route: ${booking.route}<br>
//       Date: ${booking.date}<br>
//       Status: ${booking.status}`;
//   document.getElementById("modalOverlay").style.display = "block";
//   document.getElementById("detailsModal").style.display = "block";
// }

// function closeModal() {
//   document.getElementById("modalOverlay").style.display = "none";
//   document.getElementById("detailsModal").style.display = "none";
// }

// function cancelBooking(id) {
//   const confirmCancel = confirm(
//     "Are you sure you want to cancel this booking?"
//   );
//   if (confirmCancel) {
//     const index = bookings.findIndex((b) => b.id === id);
//     if (index !== -1) {
//       bookings[index].status = "Cancelled";
//       renderTable(filteredResults());
//     }
//   }
// }

// function filteredResults() {
//   const search = searchInput.value.toLowerCase();
//   const status = filterStatus.value;
//   return bookings.filter(
//     (b) =>
//       (b.passenger.toLowerCase().includes(search) ||
//         b.route.toLowerCase().includes(search)) &&
//       (status === "" || b.status === status)
//   );
// }

// searchInput.addEventListener("input", () => renderTable(filteredResults()));
// filterStatus.addEventListener("change", () => renderTable(filteredResults()));
// renderTable(bookings);
