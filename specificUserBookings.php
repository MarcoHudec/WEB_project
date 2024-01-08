<?php
require_once("databaseScript/dbaccess.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];
    echo "User ID: $userId"; // Debugging line


    $query = "SELECT id, user_id, room_id, date_start, date_end, status, date_reservation, totalprice FROM reservations WHERE user_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Display table header
        echo "
        <table class='table fixed-width-table'>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User ID</th>
                    <th>Room ID</th>
                    <th>Date Start</th>
                    <th>Date End</th>
                    <th>Status</th>
                    <th>Date Reservation</th>
                    <th>Total Price</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>";

        // Display reservation data
        while ($row = $result->fetch_assoc()) {
            echo "
            <tr>
                <td>{$row['id']}</td>
                <td>{$row['user_id']}</td>
                <td>{$row['room_id']}</td>
                <td>{$row['date_start']}</td>
                <td>{$row['date_end']}</td>
                <td>
                    <form action='' method='post'>
                        <input type='hidden' name='id' value='{$row['id']}'>
                        <select name='status' class='form-select mb-3'>
                            <option value='new' " . ($row['status'] === 'new' ? 'selected' : '') . ">New</option>
                            <option value='confirmed' " . ($row['status'] === 'confirmed' ? 'selected' : '') . ">Confirmed</option>
                            <option value='canceled' " . ($row['status'] === 'canceled' ? 'selected' : '') . ">Canceled</option>
                        </select>
                        <button type='submit' class='btn btn-primary'>Speichern</button>
                    </form>
                </td>
                <td>{$row['date_reservation']}</td>
                <td>{$row['totalprice']}</td>
                <td><a href='adminBookingsDetailed.php?id={$row['id']}'>Details anzeigen</a></td>
            </tr>";
        }

        echo "
            </tbody>
        </table>";
    } else {
        echo "No reservations found for this user.";
    }
} else {
    echo "invalid request";
    exit();
}
?>
