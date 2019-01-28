<?php

//initializing variables
$Pno="";
$Ano="";
$SIZE="";
$COLOR="";
$GENDER="";
$PRICE="";
$BRANCH="Faisalabad";
$errors = array();

//connect to the database
$db = mysqli_connect('192.168.43.94','EasyWalk3','easywalk3','easywalk3');
//connecting to HQ
$dbHQ = mysqli_connect('192.168.43.220','EasyWalk','easywalk','easywalk');


if(isset($_POST['replicateInsert'])) {
    
  $user_check_query = "SELECT *FROM inventoryasyncho" ;
  $result = mysqli_query($db, $user_check_query);
  $resultChecked=mysqli_num_rows($result);

  if ($resultChecked > 0) { 

    while($rows = mysqli_fetch_assoc($result)) {

      $Pno=$rows['Product_ID'];
      $Ano=$rows['Article_NO'];
      $SIZE=$rows['Size'];
      $COLOR=$rows['Color'];
      $GENDER=$rows['Gender'];
      $PRICE=$rows['Price'];
      $BRANCH=$rows['Branch'];

      $query = "INSERT INTO inventory (Product_ID,Article_No,Size,Color,Gender,Price,Branch) 
                  VALUES('$Pno','$Ano', '$SIZE','$COLOR','$GENDER','$PRICE','$BRANCH')";
        mysqli_query($dbHQ, $query);


    }
  
  echo "Data inserted in HQ";

  //deleting temp records
  $user_check_query = "Delete FROM inventoryasyncho" ;
  $result = mysqli_query($db, $user_check_query);
 }
}

if(isset($_POST['replicateDelete'])) {
 
  $user_check_query = "SELECT *FROM inventoryasyncho" ;
$result = mysqli_query($db, $user_check_query);
$resultChecked=mysqli_num_rows($result);

if ($resultChecked > 0) { 

  while($rows = mysqli_fetch_assoc($result)) {

    $Pno=$rows['Product_ID'];
    $BRANCH=$rows['Branch'];

    $user_check_query = "Delete FROM inventory WHERE Product_ID='$Pno' AND Branch='$BRANCH'" ;
    mysqli_query($dbHQ, $user_check_query);
     

  }

  echo "Data Deleted from HQ";

//deleting temp records
$user_check_query = "Delete FROM inventoryasyncho" ;
$result = mysqli_query($db, $user_check_query);
}


}


if(isset($_POST['replicateModify'])) {
 
  $user_check_query = "SELECT *FROM inventoryasyncho" ;
$result = mysqli_query($db, $user_check_query);
$resultChecked=mysqli_num_rows($result);

if ($resultChecked > 0) { 

  while($rows = mysqli_fetch_assoc($result)) {

    $Pno=$rows['Product_ID'];
    $Ano=$rows['Article_NO'];
    $SIZE=$rows['Size'];
    $COLOR=$rows['Color'];
    $GENDER=$rows['Gender'];
    $PRICE=$rows['Price'];
    $BRANCH=$rows['Branch'];


      //inserting into HQ
    $query = "UPDATE inventory SET Product_ID ='$Pno',Article_No='$Ano',Size='$SIZE',Color='$COLOR',Gender='$GENDER',Price='$PRICE',Branch='$BRANCH'
    WHERE Product_ID ='$Pno' AND Branch='$BRANCH'";
    mysqli_query($dbHQ, $query);
     

  }

  echo "Data Modified in from HQ";

//deleting temp records
$user_check_query = "Delete FROM inventoryasyncho" ;
$result = mysqli_query($db, $user_check_query);
}


}


