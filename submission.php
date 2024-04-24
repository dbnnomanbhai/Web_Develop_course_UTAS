<?php
include('db_conn.php');

try {
    // Query to select paper data
    $query = "SELECT * FROM paper";

    // Execute the query
    $stmt = $db->query($query);

    if ($stmt === false) {
        die("Error executing the query");
    }

} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Paper Information</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
    }
    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
  </style>
</head>
<body>
  <h1>Paper Information</h1>

  <table border="1">
    <tr>
      <th>ID</th>
      <th>Author</th>
      <th>Type</th>
      <th>Title</th>
      <th>Abstract</th>
      <th>Location</th>
      <th>Score</th>
    </tr>
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['author']; ?></td>
        <td><?php echo $row['type']; ?></td>
        <td><?php echo $row['title']; ?></td>
        <td><?php echo $row['abstract']; ?></td>
        <td><?php echo $row['location']; ?></td>
        <td><?php echo $row['score']; ?></td>
      </tr>
    <?php } ?>
  </table>
</body>
</html>
