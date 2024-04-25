<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Submission</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1>Edit Submission</h1>
    </div>

    <div class="container p-2">
        <?php
        include('db_conn.php');

        if (isset($_GET['paper_id'])) {
            $paperID = $_GET['paper_id'];

            // Fetch the paper details from the database
            $query = "SELECT papers.paperID, users.name AS Author, locations.paper_type, locations.description AS Type, papers.title, papers.abstract
                        FROM papers
                        JOIN users ON papers.userID = users.userID
                        JOIN locations ON papers.paper_type = locations.paper_type
                        WHERE papers.paperID = :paperID";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':paperID', $paperID, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                // Fetch all paper types from the locations table
                $paperTypesQuery = "SELECT paper_type, description FROM locations";
                $paperTypesStmt = $db->query($paperTypesQuery);
                $paperTypes = $paperTypesStmt->fetchAll(PDO::FETCH_ASSOC);

                // Form to edit submission details
                ?>
                <form method="post" action="update_submission.php">
                    <div class="mb-3">
                        <label for="Author" class="form-label">Author</label>
                        <input type="text" class="form-control" id="Author" name="Author" value="<?php echo $row['Author']; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="Type" class="form-label">Type of Paper</label>
                        <select class="form-select" id="Type" name="Type">
                            <?php foreach ($paperTypes as $type) { ?>
                                <option value="<?php echo $type['paper_type']; ?>" <?php if ($type['paper_type'] == $row['paper_type']) echo 'selected'; ?>><?php echo $type['description']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="Title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="Title" name="Title" value="<?php echo $row['title']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="Abstract" class="form-label">Abstract</label>
                        <textarea class="form-control" id="Abstract" name="Abstract" rows="3"><?php echo $row['abstract']; ?></textarea>
                    </div>
                    <input type="hidden" name="paperID" value="<?php echo $row['paperID']; ?>">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="submission.php" class="btn btn-secondary">Cancel</a>
                </form>
            <?php
            } else {
                // Paper not found
                echo "<p>Paper not found.</p>";
            }
        } else {
            // No paper ID provided
            echo "<p>No paper ID provided.</p>";
        }
        ?>
    </div>

</body>

</html>
