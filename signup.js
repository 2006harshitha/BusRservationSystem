function getQueryParam(key) {
    return new URLSearchParams(window.location.search).get(key);
  }
  
  function getDayName(dateStr) {
    return new Date(dateStr).toLocaleString("en-US", { weekday: "long" });
  }
  
  function applyFilters() {
    // Get dropdown values instead of checkboxes
    const busType = document.getElementById("busType").value;
    const seatType = document.getElementById("seatType").value;
  
    const ac = busType === "AC";
    const nonAc = busType === "Non-AC";
    const sleeper = seatType === "Sleeper";
    const seater = seatType === "Seater";
  
    const from = getQueryParam("from");
    const to = getQueryParam("to");
    const date = getQueryParam("date");
    const passengers = parseInt(getQueryParam("passengers"), 10);
    const day = getDayName(date);
  
    console.log("From:", from);
    console.log("To:", to);
    console.log("Date:", date);
    console.log("Passengers:", passengers);
    console.log("Day:", day);
    console.log("Selected Filters:");
    console.log("AC:", ac);
    console.log("Non-AC:", nonAc);
    console.log("Sleeper:", sleeper);
    console.log("Seater:", seater);
  
    fetch("../backend/get_buses.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        from,
        to,
        date,
        day,
        passengers,
        filters: { ac, nonAc, sleeper, seater },
      }),
    })
      .then((res) => res.json())
      .then((buses) => {
        const busList = document.getElementById("busList");
        busList.innerHTML = "";
  
        if (buses.length === 0) {
          busList.innerHTML = "<p>No buses found.</p>";
          return;
        }
  
        buses.forEach((bus) => {
          const price = bus.base_price;
  
          busList.innerHTML += `
    <div style="background-color:rgb(166, 222, 229); border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); padding: 20px; margin-bottom: 20px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; max-width: 500px; margin: 20px auto; transition: transform 0.3s ease, box-shadow 0.3s ease;">
      <h3 style="font-size: 1.4rem; color: #2c3e50; margin-bottom: 10px;">${
        bus.bus_name
      }</h3>
      <p style="margin: 6px 0; color: #1f6feb; font-weight: bold;">${
        bus.origin
      } → ${bus.destination}</p>
      <p style="margin: 6px 0; color: #555; font-size: 0.95rem;">Timing: ${
        bus.start_time
      } - ${bus.end_time}</p>
      <p style="margin: 6px 0; color: #555; font-size: 0.95rem;">Available Seats: ${
        bus.total_seats
      }</p>
      <p style="margin: 6px 0; font-weight: bold; color: #27ae60; font-size: 1rem;">Price (for ${passengers}): ₹${(
            price * passengers
          ).toFixed(2)}</p>
      <button 
        onclick="bookBus(${bus.bus_id}, '${bus.seat_type}')" 
        style="margin-top: 10px; background-color: #1f6feb; color: white; border: none; padding: 10px 16px; border-radius: 6px; cursor: pointer; font-weight: bold;">
        Continue
      </button>
    </div>
  `;
        });
      })
      .catch((err) => console.error("Error fetching buses:", err));
  }
  
  // Show travel info and apply filters on page load
  window.addEventListener("DOMContentLoaded", () => {
    const from = getQueryParam("from");
    const to = getQueryParam("to");
    const date = getQueryParam("date");
    const passengers = getQueryParam("passengers");
  
    // Optional: Show travel summary info
    const infoDiv = document.createElement("div");
    infoDiv.innerHTML = `
        <p><strong>From:</strong> ${from} | <strong>To:</strong> ${to} | <strong>Date:</strong> ${date} | <strong>Passengers:</strong> ${passengers}</p>
      `;
    document.body.insertBefore(infoDiv, document.getElementById("busList"));
  
    applyFilters(); // initial load
  });