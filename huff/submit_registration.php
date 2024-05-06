<?php
var_dump($_POST);
// Get form data
$UName = $_POST['UName'];
$Email= $_POST['Email'];
$Gender = $_POST['Gender'];
$BloodGroup = $_POST['BloodGroup'];

$City = $_POST['City'];
$Adress = $_POST['Adress'];


if (!empty($UName) || !empty($Email) || !empty($BloodGroup)  || !empty($City ) || !empty($Adress) )

{

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "registration";



// Create connection
$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT Email From usersregistered Where Email = ? Limit 1";
  $INSERT = "INSERT INTO usersregistered (UName, Email, Gender, BloodGroup, City, Adress) VALUES (?, ?, ?, ?, ?, ?)";


//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $Email);
     $stmt->execute();
     $stmt->bind_result($Email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0)
       {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssss", $UName,$Email,$Gender,$BloodGroup,$City,$Adress );
      $stmt->execute();
      echo "New record inserted sucessfully";
     } 
     else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>
















