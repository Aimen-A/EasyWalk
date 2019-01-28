<?php

//initializing variables
$Pno="";
$name="";
$date="";
$BRANCH="Lahore";
$errors = array();


//connect to the database
$db = mysqli_connect('192.168.43.21','EasyWalk2','easywalk2','easywalk2');
//connect to headquarter database
$dbHQ = mysqli_connect('192.168.43.220','EasyWalk','easywalk','easywalk');

if(isset($_POST['replicateInsert'])) {
    
  $user_check_query = "SELECT * FROM salesasyncho " ;
  $result = mysqli_query($db, $user_check_query);
  $resultChecked=mysqli_num_rows($result);

  if ($resultChecked > 0) { 

    while($rows = mysqli_fetch_assoc($result)) {

      $Pno=$rows['Product_ID'];
      $name=$rows['CustomerName'];
      $date=$rows['dateTrans'];
      $price=$rows['Price'];
      $BRANCH=$rows['Branch'];

      $user_check_query = "Delete FROM inventory WHERE Product_ID='$Pno' AND Branch='Lahore'" ;
      mysqli_query($dbHQ, $user_check_query);


      $query = "INSERT INTO sales(Product_ID,CustomerName,dateTrans,Price,Branch) 
      VALUES('$Pno','$name','$date','$price','$BRANCH')";
      mysqli_query($dbHQ, $query);

    }
  
  echo "Data inserted in HQ";

  //deleting temp records
  $user_check_query = "Delete FROM salesasyncho" ;
  $result = mysqli_query($db, $user_check_query);
 }
}



//deleteing

if(isset($_POST['replicateDelete'])) {
 
  $user_check_query = "SELECT *FROM salesasyncho" ;
$result = mysqli_query($db, $user_check_query);
$resultChecked=mysqli_num_rows($result);

if ($resultChecked > 0) { 

  while($rows = mysqli_fetch_assoc($result)) {

    $Pno=$rows['Product_ID'];
    $BRANCH=$rows['Branch'];

    $user_check_query = "Delete FROM sales WHERE Product_ID='$Pno' AND Branch='$BRANCH'" ;
    mysqli_query($dbHQ, $user_check_query);
     

  }

  echo "Data Deleted from HQ";

//deleting temp records
$user_check_query = "Delete FROM salesasyncho" ;
$result = mysqli_query($db, $user_check_query);
}


}



//modification
if(isset($_POST['replicateModify'])) {
 
  $user_check_query = "SELECT *FROM salesasyncho" ;
$result = mysqli_query($db, $user_check_query);
$resultChecked=mysqli_num_rows($result);

if ($resultChecked > 0) { 

  while($rows = mysqli_fetch_assoc($result)) {

    $Pno=$rows['Product_ID'];
      $name=$rows['CustomerName'];
      $date=$rows['dateTrans'];
      $price=$rows['Price'];
      $BRANCH=$rows['Branch'];

    
    $query = "UPDATE sales SET Product_ID ='$Pno',CustomerName='$name',dateTrans='$date',Price='$price'
    WHERE Product_ID ='$Pno' AND BRANCH='$BRANCH'";
    mysqli_query($dbHQ, $query);
    echo "<br>"."Data Modified successfully"."<br>";
     

  }



//deleting temp records
$user_check_query = "Delete FROM salesasyncho" ;
$result = mysqli_query($db, $user_check_query);
}


}




?>