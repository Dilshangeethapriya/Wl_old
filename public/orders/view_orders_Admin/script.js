document.addEventListener("DOMContentLoaded", function () {
    const searchInput = document.querySelector(".input-group input");
    const searchIcon = document.querySelector(".input-group img:nth-child(3)"); // Assuming the second image is the search icon
    const clearIcon = document.querySelector(".input-group img:nth-child(2)"); // Assuming the first image is the cross icon

    function fetchOrders(orderID = "") {
        console.log("Fetching orders for order ID:", orderID); // Debugging
        const xhr = new XMLHttpRequest();
        xhr.open(
            "GET",
            "fetch_orders.php?orderID=" +
                encodeURIComponent(orderID) +
                "&nocache=" +
                new Date().getTime(),
            true
        );

        xhr.onload = function () {
            if (this.status === 200) {
                const orders = JSON.parse(this.responseText);
                console.log("Orders received:", orders); // Debugging
                const tableBody = document.getElementById("order-table-body");

                tableBody.innerHTML = ""; // Clear existing table data

                if (orders.length === 0) {
                    console.log("No orders found"); // Debugging
                    tableBody.innerHTML =
                        '<tr><td colspan="8">No orders found.</td></tr>';
                } else {
                    orders.forEach((order) => {
                        const row = document.createElement("tr");

                        row.innerHTML = `
                            <td><a href="customer_details.php?orderID=${
                                order.orderID
                            }<td>">${order.orderID}</a></td>
                            <td>${order.customerID}</td>
                            <td>${order.total}</td>
                            <td>${order.orderDate}</td>
                            <td>${order.paymentMethod}</td>
                            <td>sdasd</td>
                            <td id="order-status-${order.orderID}">${
                            order.orderStatus
                        }</td>
                            <td>
                                <select class="order-status" data-order-id="${
                                    order.orderID
                                }">
                                    <option value="pending" ${
                                        order.orderStatus === "Pending"
                                            ? "selected"
                                            : ""
                                    }>Pending</option>
                                    <option value="completed" ${
                                        order.orderStatus === "Completed"
                                            ? "selected"
                                            : ""
                                    }>Completed</option>
                                    <option value="declined" ${
                                        order.orderStatus === "Declined"
                                            ? "selected"
                                            : ""
                                    }>Declined</option>
                                </select>
                            </td>
                        `;

                        tableBody.appendChild(row);
                    });

                    // Add event listeners for status change
                    document
                        .querySelectorAll(".order-status")
                        .forEach((select) => {
                            select.addEventListener("change", function () {
                                const orderID =
                                    this.getAttribute("data-order-id");
                                const newStatus = this.value;

                                const xhrUpdate = new XMLHttpRequest();
                                xhrUpdate.open(
                                    "POST",
                                    "update_order_status.php",
                                    true
                                );
                                xhrUpdate.setRequestHeader(
                                    "Content-Type",
                                    "application/x-www-form-urlencoded"
                                );
                                xhrUpdate.onload = function () {
                                    if (this.status === 200) {
                                        console.log(
                                            `Server response: ${this.responseText}`
                                        );
                                    } else {
                                        console.error(
                                            "Failed to update status. Server responded with:",
                                            this.status
                                        );
                                    }
                                };
                                xhrUpdate.send(
                                    `orderID=${orderID}&status=${newStatus}`
                                );
                            });
                        });
                }
            } else {
                console.error(
                    "Failed to fetch orders. Server responded with:",
                    this.status
                );
            }
        };
        xhr.send();
    }

    // Event listener for search icon click
    searchIcon.addEventListener("click", function () {
        const customerID = searchInput.value.trim();
        console.log("Search icon clicked, Customer ID:", customerID); // Debugging
        fetchOrders(customerID); // Fetch orders filtered by the Customer ID
    });

    // Event listener for clear icon click
    clearIcon.addEventListener("click", function () {
        searchInput.value = ""; // Clear the input field
        console.log("Clear icon clicked"); // Debugging
        fetchOrders(); // Fetch all orders again
    });

    // Initial fetch to display all orders when the page loads
    fetchOrders(); // Fetch all orders by default
});
