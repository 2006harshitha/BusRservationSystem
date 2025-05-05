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
  
    fetch("backend/get_buses.php", {
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
            busList.innerHTML = "<p style='grid-column:1/-1; text-align:center;'>No buses found matching your criteria.</p>";
            return;
        }
  
        buses.forEach((bus) => {
            const price = bus.base_price;
            const busCard = document.createElement("div");
            busCard.className = "bus-card";
            busCard.innerHTML = `
                <div class="bus-header">
                    <h3>${bus.bus_name}</h3>
                    <span class="bus-type">${bus.bus_type}</span>
                </div>
                <div class="bus-details">
                    <p><strong>Bus id:</strong> ${bus.bus_id}</p>
                    <p><strong>Route:</strong> ${bus.origin} → ${bus.destination}</p>
                    <p><strong>Timing:</strong> ${bus.start_time} - ${bus.end_time}</p>
                  
                    <p><strong>Seats Available:</strong> ${bus.total_seats}</p>
                    <p><strong>Price for ${passengers}:</strong> ₹${(price * passengers).toFixed(2)}</p>
                </div>
                <button class="book-btn">Book Now</button>
            `;
            busList.appendChild(busCard);

            // Add event listener to the "Book Now" button
            busCard.querySelector(".book-btn").addEventListener("click", (e) => {
                // Get the bus data
                const busData = {
                    bus_id: bus.bus_id.toString(), // Convert to string to be safe
                    bus_name: bus.bus_name,
                    bus_type: bus.bus_type,
                    origin: bus.origin,
                    destination: bus.destination,
                    start_time: bus.start_time,
                    end_time: bus.end_time,
                    duration: bus.duration,
                    total_seats: bus.total_seats.toString(),
                    base_price: bus.base_price.toString()
                };
                
                // Add journey details
                const journeyDetails = {
                    from: from,
                    to: to,
                    date: date,
                    passengers: passengers.toString()
                };
                
                // Combine all into one params object
                const params = new URLSearchParams({
                    ...busData,
                    ...journeyDetails
                });
                
                // Redirect to passenger.html with all params
                window.location.href = `passenger.html?${params.toString()}`;
                
            });
        });
    })
    .catch((err) => {
        console.error("Error fetching buses:", err);
        const busList = document.getElementById("busList");
        busList.innerHTML = "<p style='grid-column:1/-1; text-align:center; color:var(--accent-color);'>Error loading bus data. Please try again.</p>";
    });
}

// Show travel info and apply filters on page load
window.addEventListener("DOMContentLoaded", () => {
    const from = getQueryParam("from");
    const to = getQueryParam("to");
    const date = getQueryParam("date");
    const passengers = getQueryParam("passengers");
  
    // Show travel summary info
    const infoDiv = document.getElementById("travelInfo");
    if (infoDiv) {
        infoDiv.innerHTML = `
            <h2>Search Results</h2>
            <p><strong>From:</strong> ${from} | <strong>To:</strong> ${to}</p>
            <p><strong>Date:</strong> ${date} | <strong>Passengers:</strong> ${passengers}</p>
        `;
    }
  
    applyFilters(); // initial load
});
