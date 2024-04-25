<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Paper Form</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 class="mt-5 mb-4">Submit Your Paper</h1>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="paperForm">
                    <div class="mb-3">
                        <label for="author" class="form-label">Author</label>
                        <input type="text" class="form-control" id="author" name="author" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="affiliate" class="form-label">Affiliate</label>
                        <input type="text" class="form-control" id="affiliate" name="affiliate" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Paper</button>
                    <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                </form>
            </div>
            <div class="col-md-6">
                <div id="additionalFields" style="display: none;">
                    <h2 class="mt-5 mb-4">Add Additional Details</h2>
                    <form method="post" action="createsubmission.php">
                        <div class="mb-3">
                            <label for="typeOfPaper" class="form-label">Type of Paper</label>
                            <input type="text" class="form-control" id="typeOfPaper" name="typeOfPaper" required>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="abstract" class="form-label">Abstract</label>
                            <textarea class="form-control" id="abstract" name="abstract" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Paper</button>
                        <button type="button" class="btn btn-secondary" id="cancelAdditionalBtn">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
        
            $("#additionalFields").hide();

            $("#paperForm").submit(function(event) {
                event.preventDefault();

                var author = $("#author").val();
                var email = $("#email").val();
                var affiliate = $("#affiliate").val();

                $.ajax({
                    type: "POST",
                    url: "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>", 
                    data: { author: author, email: email, affiliate: affiliate },
                    success: function(response) {
                        if (response == "exists") {
                            alert("Author details already registered!");
                        } else {
                            $("#additionalFields").show();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            });

       
            $("#cancelAdditionalBtn").click(function() {
                $("#additionalFields").hide();
            });

            // Cancel main form
            $("#cancelBtn").click(function() {
                $("#author").val("");
                $("#email").val("");
                $("#affiliate").val("");
            });
        });
    </script>

    <?php
 
    $dbFile = '/var/www/html/najmulu/phpliteadmin/db/tutorial6.db';

    try {
       
        $db = new PDO("sqlite:$dbFile");
    
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
 
        echo "Connection failed: " . $e->getMessage();
    }

  
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
        if (!empty($_POST['author']) && !empty($_POST['email']) && !empty($_POST['affiliate'])) {
            $author = $_POST['author'];
            $email = $_POST['email'];
            $affiliate = $_POST['affiliate'];

            try {
 
                $stmt_insert_paper = $db->prepare("INSERT INTO papers (author, email, affiliate) VALUES (:author, :email, :affiliate)");
      
                $stmt_insert_paper->bindParam(':author', $author);
                $stmt_insert_paper->bindParam(':email', $email);
                $stmt_insert_paper->bindParam(':affiliate', $affiliate);
                $stmt_insert_paper->execute();
            
                echo "<script>alert('Submission unsuccessful!');</script>";
            } catch(PDOException $e) {
              
                echo "Error: " . $e->getMessage();
            }
        } else {
             
             echo "<script>alert('Submission successful!');</script>";
        }
    }
    ?>
</body>
</html>
