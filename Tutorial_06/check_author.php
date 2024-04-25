<?php
// Include database connection
include('db_conn.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $email = $_POST['EmailAddress'];

    // Query to check if author information exists in the database
    $query = "SELECT * FROM users WHERE email_address = :email";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // Author exists in the database
        // Redirect to the page where you want to display existing author's information
        header("Location: author_info.php?email=$email");
        exit();
    } else {
        // Author doesn't exist in the database
        // Display form for submitting a new paper
        echo "<h2>Submit New Paper</h2>";
        echo "<form id='submitPaperForm'>";
        echo "<input type='hidden' name='email' value='$email'>";
        echo "<div class='mb-3'>";
        echo "<label for='paperType' class='form-label'>Type of Paper</label>";
        echo "<input type='text' class='form-control' id='paperType' name='paperType'>";
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<label for='title' class='form-label'>Title</label>";
        echo "<input type='text' class='form-control' id='title' name='title'>";
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<label for='abstract' class='form-label'>Abstract</label>";
        echo "<textarea class='form-control' id='abstract' name='abstract' rows='3'></textarea>";
        echo "</div>";
        echo "<div class='mb-3'>";
        echo "<button type='button' class='btn btn-primary' id='addPaper'>Add Paper</button>";
        echo "<button type='button' class='btn btn-secondary' id='cancel'>Cancel</button>";
        echo "</div>";
        echo "</form>";
    }
}
?>
