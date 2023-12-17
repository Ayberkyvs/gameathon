<?php
// Veritabanı bağlantınızı yapın
include ('php/baglan.php');

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["group_name"])) {
        $groupName = $_GET["group_name"];

        // Grup adının benzersiz olup olmadığını kontrol edin
        $sql = "SELECT COUNT(*) AS count FROM gruplar WHERE grup_adi = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $groupName);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row["count"] > 0) {
            echo json_encode(["available" => false]);
        } else {
            echo json_encode(["available" => true]);
        }
    }
}

$conn->close();
?>