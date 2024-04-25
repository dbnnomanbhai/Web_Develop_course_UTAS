<?php
//the database connection file
include('db_conn.php');

// Check if the paper ID is provided
if(isset($_POST['paper_id'])) {
    $paperID = $_POST['paper_id'];

    // SQL statement to fetch reviewer's information and their score for the paper
    $query = "SELECT users.name AS Reviewer, review.result AS Score
              FROM review
              JOIN users ON review.userID = users.userID
              WHERE review.paperID = :paper_id";

    // Executing the SQL statement
    $stmt = $db->prepare($query);
    $stmt->bindParam(':paper_id', $paperID, PDO::PARAM_INT);
    $stmt->execute();

    // Fetching the result
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Checking if the reviewer's information is found
    if($result) {
        // Output the reviewer's name and their score
        echo "Reviewer: " . $result['Reviewer'] . "<br>";
        echo "Score: " . $result['Score'];
    } else {
        // If no reviewer's information found
        echo "Reviewer information not found.";
    }
} else {
    // If paper ID is not provided, error message
    echo "Error: Paper ID not provided.";
}
?>
