<?php
//connect
require_once ('db.php');

// query
$sql = "SELECT * FROM albums";
$cmd = $conn->prepare($sql);
$cmd->execute();
$albums = $cmd->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($albums);

// disconnect
$conn = null;

?>
