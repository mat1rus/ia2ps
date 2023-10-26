<?
require "conf/db.php";
require "conf/secret.php";

if($secret_required) {
  if($_GET["verify"] != $secret_get) {
    echo "-666";
    exit();
  };
};

$sql = "SELECT name, desc1, desc2, typeID, cost, prize FROM items";
$resp = $conn -> query($sql);

if($resp -> num_rows > 0) {
  while($row = $result -> fetch_assoc()) {
    echo $row["name"]. ":" . $row["desc1"]. ":" . $row["desc2"]. ":" . $row["prize"] . ":" . $row["typeID"] . ":" . $row["cost"] . ":;";
  };
};

$conn -> close();
?>