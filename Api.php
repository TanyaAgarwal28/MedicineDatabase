<?php 
 
 /*
 * Created by Belal Khan
 * website: www.simplifiedcoding.net 
 * Retrieve Data From MySQL Database in Android
 */
 
 //database constants
 define('DB_HOST', 'localhost');
 define('DB_USER', 'root');
 define('DB_PASS', '');
 define('DB_NAME', 'medicinedatabase');
 
 //connecting to database and getting the connection object
 $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
 
 //Checking if any error occured while connecting
 if (mysqli_connect_errno()) {
 echo "Failed to connect to MySQL: " . mysqli_connect_error();
 die();
 }
 
 //creating a query
 $stmt = $conn->prepare("SELECT BarcodeNumber, Name, Price, ExpiryDate, ManufacturingDate FROM medicine;");
 
 //executing the query 
 $stmt->execute();
 
 //binding results to the query 
 $stmt->bind_result($BarcodeNumber, $Name, $Price, $ExpiryDate, $ManufacturingDate);
 
 $medicine = array(); 
 
 //traversing through all the result 
 while($stmt->fetch()){
 $temp = array();
 $temp['BarcodeNumber'] = $BarcodeNumber; 
 $temp['Name'] = $Name; 
 $temp['Price'] = $Price; 
 $temp['ExpiryDate'] = $ExpiryDate; 
 $temp['ManufacturingDate'] = $ManufacturingDate; 
 array_push($medicine, $temp);
 }
 
 //displaying the result in json format 
 echo json_encode($medicine);