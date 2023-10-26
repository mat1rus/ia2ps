<?
$servername = "localhost";
$username = "user";
$password = "pass";
$dbname = "ia2";

$conn = new mysqli($servername, $username, $password, $dbname);
if($conn -> connect_error) {
  die("lol rip " . $conn -> connect_error);
};
?>