<?
require "conf/db.php";
require "conf/secret.php";

if($secret_required) {
  if($_GET["verify"] != $secret_upload) {
    echo "-666";
    exit();
  };
};

$name = substr($_GET["name"], 0, 16); // maxlen: 16
$desc1 = substr($_GET["desc1"], 0, 22); // maxlen: 22
$desc2 = substr($_GET["desc2"], 0, 22); // maxlen: 22
$typeID = (int)$_GET["typeID"]; // either 1 or 2
$cost = (int)$_GET["cost"]; // from 20000 to 100000 and cost % 100 = 0, from 20000 to 1000000 and cost % 1000 = 0
$prize = (int)$_GET["prize"]; // from 1000 to 5000 and prize % 5 = 0, from 1000 to 50000 and prize % 50 = 0

// basic check
if(($cost < 20000 || $cost > 1000000) || ($prize < 1000 || $prize > 50000) || ($typeID != 1 && $typeID != 2)) {
  echo "-1BC";
  exit();
};

// advanced check
if(($cost % 100 != 0) || ($prize % 5 != 0)) {
  echo "-1AC1";
  exit();
};
if($cost > 100000) {
  if($cost % 1000 != 0) {
    echo "-1AC2COST";
    exit();
  };
};
if($prize > 5000) {
  if($prize % 50 != 0) {
    echo "-1AC2PRIZE";
    exit();
  };
};

$q = "INSERT INTO items (name, desc1, desc2, typeID, cost, prize) VALUES ('$name', '$desc1', '$desc2', '$typeID', '$cost', '$prize')";
if($conn -> query($q) === TRUE) {
  echo "1";
} else {
  echo "lol rip " . $sql . "\n" . $conn -> error;
};

$conn -> close();
?>