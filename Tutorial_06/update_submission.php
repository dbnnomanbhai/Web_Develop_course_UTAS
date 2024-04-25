<?php
include('db_conn.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input data
    $paperID = $_POST['paperID'];
    $type = $_POST['Type'];
    $title = $_POST['Title'];
    $abstract = $_POST['Abstract'];

    // Update submission details in the database
    $query = "UPDATE papers SET paper_type = :type, title = :title, abstract = :abstract WHERE paperID = :paperID";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':type', $type, PDO::PARAM_INT);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':abstract', $abstract, PDO::PARAM_STR);
    $stmt->bindParam(':paperID', $paperID, PDO::PARAM_INT);

    if ($stmt->execute()) {
        // Submission details updated successfully
        header("Location: submission.php");
        exit();
    } else {
        // Failed to update submission details
        echo "<p>Failed to update submission details.</p>";
    }
} else {
    // Invalid request method
    echo "<p>Invalid request method.</p>";
}
?>
