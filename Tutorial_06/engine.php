<?php

include('db_conn.php');

if(isset($_POST['add'])){
    $id = $_POST['itemID'];
    $desc = $_POST['description'];
    $quan = $_POST['quantity'];

$sql = "INSERT INTO prac_item (itemID, description, quantity) VALUES (?, ?, ?) ";
$stmt = $db->prepare($sql);
$stmt ->execute([$id, $desc, $quan]);

echo "<script>
window.location.href='item.php';
alert('Item has been updated');
</script>";
}



if(isset($_POST['update'])){
    $id = $_POST['itemID'];
    $desc = $_POST['description'];
    $quan = $_POST['quantity'];

$sql = "UPDATE prac_item SET description=?, quantity=? WHERE itemID = ?";
$stmt = $db->prepare($sql);
$stmt ->execute([$desc, $quan, $id]);

echo "<script>
window.location.href='item.php';
alert('Item has been updated');
</script>";
}

if(isset($_POST['delete'])){
    $id = $_POST['item_id'];
  
$sql = "DELETE FROM prac_item WHERE itemID = ?";
$stmt = $db->prepare($sql);
$stmt ->execute([ $id]);

echo "<script>
window.location.href='item.php';
alert('Item has been deleted');
</script>";
}
?>