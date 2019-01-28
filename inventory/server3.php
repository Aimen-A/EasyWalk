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

//connect to headquarter database
$dbHQ = mysqli_connect('192.168.43.220','EasyWalk','easywalk','easywalk');

if(isset($_POST['inventoringInsert'])) {
  //recieve all inputted walues from the form
  $Pno=mysqli_real_escape_string($db,$_POST['pNo']);
  $Ano=mysqli_real_escape_string($db,$_POST['aNo']);
  $SIZE=mysqli_real_escape_string($db,$_POST['size']);
  $COLOR=mysqli_real_escape_string($db,$_POST['color']);
  $GENDER=mysqli_real_escape_string($db,$_POST['gender']);
  $PRICE=mysqli_real_escape_string($db,$_POST['price']);
  

  // form validation: ensure that the form is correctly filled ...
// by adding (array_push()) corresponding error unto $errors array
if (empty($Pno)) { array_push($errors, "*Product No is required"); }
if (empty($Ano)) { array_push($errors, "*Article No is required"); }
if (empty($SIZE)) { array_push($errors, "*Size is required"); }
if (empty($COLOR)) { array_push($errors, "*Color is required"); }
if (empty($GENDER)) { array_push($errors, "*Gender is required"); }
if (empty($PRICE)) { array_push($errors, "*Price is required"); }
if (empty($BRANCH)) { array_push($errors, "*Branch is required"); }


// PRODUCT ALREADY EXIST IN ITS OWN DB?
$user_check_query = "SELECT * FROM inventory WHERE Product_ID='$Pno'" ;
$result = mysqli_query($db, $user_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) { // if Pno exists
  if ($user['Product_ID'] === $Pno) {
    array_push($errors, "*Product Already Exist");
    }}

// PRODUCT ALREADY EXIST IN HQ DB?

$user_check_query = "SELECT * FROM inventory WHERE Product_ID='$Pno'" ;
$result = mysqli_query($dbHQ, $user_check_query);
$user = mysqli_fetch_assoc($result);

if ($user) { // if Pno exists
  if ($user['Product_ID'] === $Pno) {
    array_push($errors, "*Product Already Exist");
    echo "product already exists";}}
    
   //IF NOT EXIST IN ITS OWN DB  OR HQ DB THEN INSERT IN HQ DB
   if (count($errors) == 0) {
      $query = "INSERT INTO inventory (Product_ID,Article_No,Size,Color,Gender,Price,Branch) 
                VALUES('$Pno','$Ano', '$SIZE','$COLOR','$GENDER','$PRICE','$BRANCH')";
      mysqli_query($dbHQ, $query);
      echo "Data inserted";
  } 
   //IF NOT EXIST IN ITS OWN DB  OR HQ DB THEN INSERT IN ITS OWN DB
   if (count($errors) == 0) {
      $query = "INSERT INTO inventory (Product_ID,Article_No,Size,Color,Gender,Price,Branch) 
                VALUES('$Pno','$Ano', '$SIZE','$COLOR','$GENDER','$PRICE','$BRANCH')";
      mysqli_query($db, $query);
  } 
}//END OF INSERTION

if(isset($_POST['inventoringSearch'])) {

 
  //recieve all inputted walues from the form
  $Pno=mysqli_real_escape_string($db,$_POST['pNo']);
 
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($Pno)) { array_push($errors, "*Product No is required"); }

//search query
  $user_check_query = "SELECT * FROM inventory WHERE Product_ID='$Pno'" ;
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if Pno exists
    if (count($errors) == 0) {
      echo "<table class='tableheadings'>
      <tr>
      <th>Product_ID</th>
      <th>Article_NO</th>
      <th>Size</th>
      <th>Color</th>
      <th>Gender</th>
      <th>Price</th>
      <th>Branch</th>
      </tr>
      <tr>
      <td>".$user['Product_ID']."</td>
      <td>".$user['Article_NO']."</td>
      <td>".$user['Size']."</td>
      <td>".$user['Color']."</td>
      <td>".$user['Gender']."</td>
      <td>".$user['Price']."</td>
      <td>".$user['Branch']."</td>
      </tr>
      </table>";
    }
  }
  else
  {
    echo "Entered ID doesnot exist"; 
  } 
}//END OF SEARCH


if(isset($_POST['inventoringShow'])) {
 
  //QUERY TO SELECT ALL DATA
  $user_check_query = "SELECT *FROM inventory" ;
  $result = mysqli_query($db, $user_check_query);
  $resultChecked=mysqli_num_rows($result);

  if ($resultChecked > 0) { 
    echo "<table class='tableheadings'>
    <tr>
    <th>Product_ID</th>
    <th>Article_NO</th>
    <th>Size</th>
    <th>Color</th>
    <th>Gender</th>
    <th>Price</th>
    <th>Branch</th>
    </tr>
    </table>";
    while($rows = mysqli_fetch_assoc($result)) {
      echo "
      <table class='tableheadings'>
      <tr>
      <td>".$rows['Product_ID']."</td>
      <td>".$rows['Article_NO']."</td>
      <td>".$rows['Size']."</td>
      <td>".$rows['Color']."</td>
      <td>".$rows['Gender']."</td>
      <td>".$rows['Price']."</td>
      <td>".$rows['Branch']."</td>
      </tr>
      </table>";
    }
  }
  else
  {
    array_push($errors, "No Data Exists"); 
    echo "No DATA exist";
  } 
}//END SHOW ALL


if(isset($_POST['inventoringDelete'])) {
 
  //recieve all inputted walues from the form
  $Pno=mysqli_real_escape_string($db,$_POST['pNo']);
 
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($Pno)) { array_push($errors, "*Product No is required"); }


//QUERY TO SEE IF DATA REQUESTED FOR DELETION EXIST
  $user_check_query = "SELECT * FROM inventory WHERE Product_ID='$Pno'" ;
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if Pno exists
    if (count($errors) == 0) {
      echo "<table class='tableheadings'>
      <tr>
      <th>Product_ID</th>
      <th>Article_NO</th>
      <th>Size</th>
      <th>Color</th>
      <th>Gender</th>
      <th>Price</th>
      <th>Branch</th>
      </tr>
      <tr>
      <td>".$user['Product_ID']."</td>
      <td>".$user['Article_NO']."</td>
      <td>".$user['Size']."</td>
      <td>".$user['Color']."</td>
      <td>".$user['Gender']."</td>
      <td>".$user['Price']."</td>
      <td>".$user['Branch']."</td>
      </tr>
      </table>";
    }

    //DELETION QUERY
  $user_check_query = "Delete FROM inventory WHERE Product_ID='$Pno'" ;
  $result = mysqli_query($db, $user_check_query);
  if($result)
  {
    echo "<br >"."Above Data Deleted successfully"."<br/>"."<hr/>";
  }else{
    echo "<br >"."Above Data Not Deleted successfully"."<br/>"."<hr/>";
  }

  //SEARCHING THEN DELETING THE DATA FROM HQ DB
  $user_check_query = "SELECT * FROM inventory WHERE Product_ID='$Pno' AND Branch='Faisalabad'" ;
  $result = mysqli_query($dbHQ, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  $user_check_query = "Delete FROM inventory WHERE Product_ID='$Pno'" ;
  $result = mysqli_query($dbHQ, $user_check_query);
    
  }
  else{
    echo "The data you are trying to DELETE doesnot exists";
  }
}//END DELETE


if(isset($_POST['inventoringModify'])) {
 
  //recieve all inputted walues from the form
  $Pno=mysqli_real_escape_string($db,$_POST['pNo']);
 
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($Pno)) { array_push($errors, "*Product No is required"); }

//QUERY TO SELECT DATA REQUESTED FOR MODIFICATION
  $user_check_query = "SELECT * FROM inventory WHERE Product_ID='$Pno' AND Branch='Faisalabad'" ;
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if Pno exists
    if (count($errors) == 0) {
      echo "OLD RECORD"."<br/>"; //DISPLAYING DATA BEFORE MODIFICATION
      echo "<table class='tableheadings'>
      <tr>
      <th>Product_ID</th>
      <th>Article_NO</th>
      <th>Size</th>
      <th>Color</th>
      <th>Gender</th>
      <th>Price</th>
      <th>Branch</th>
      </tr>
      <tr>
      <td>".$user['Product_ID']."</td>
      <td>".$user['Article_NO']."</td>
      <td>".$user['Size']."</td>
      <td>".$user['Color']."</td>
      <td>".$user['Gender']."</td>
      <td>".$user['Price']."</td>
      <td>".$user['Branch']."</td>
      </tr>
      </table>";
    
       //recieve all inputted walues from the form
    $Pno=mysqli_real_escape_string($db,$_POST['pNo']);
    $Ano=mysqli_real_escape_string($db,$_POST['aNo']);
    $SIZE=mysqli_real_escape_string($db,$_POST['size']);
    $COLOR=mysqli_real_escape_string($db,$_POST['color']);
    $GENDER=mysqli_real_escape_string($db,$_POST['gender']);
    $PRICE=mysqli_real_escape_string($db,$_POST['price']);
    

    // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($Pno)) { array_push($errors, "*Product No is required"); }
  if (empty($Ano)) { array_push($errors, "*Article No is required"); }
  if (empty($SIZE)) { array_push($errors, "*Size is required"); }
  if (empty($COLOR)) { array_push($errors, "*Color is required"); }
  if (empty($GENDER)) { array_push($errors, "*Gender is required"); }
  if (empty($PRICE)) { array_push($errors, "*Price is required"); }
  if (empty($BRANCH)) { array_push($errors, "*Branch is required"); }
  //Update Data if no Error
  if (count($errors) == 0) {
    //MODIFICAATION QUERY
    $query = "UPDATE inventory SET Product_ID ='$Pno',Article_No='$Ano',Size='$SIZE',Color='$COLOR',Gender='$GENDER',Price='$PRICE',Branch='$BRANCH'
    WHERE Product_ID ='$Pno'";
    mysqli_query($db, $query);
    echo "<br>"."Data Modified successfully"."<br>";

    //QUERY TO SELEXT AFTER MODIFICATION FOR DISPLAYING PURPOSE
    $user_check_query = "SELECT * FROM inventory WHERE Product_ID='$Pno'" ;
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if Pno exists
    if (count($errors) == 0) {
      echo "NEW RECORD"."<br/>";
      
      
      echo "<table class='tableheadings'>
      <tr>
      <th>Product_ID</th>
      <th>Article_NO</th>
      <th>Size</th>
      <th>Color</th>
      <th>Gender</th>
      <th>Price</th>
      <th>Branch</th>
      </tr>
      <tr>
      <td>".$user['Product_ID']."</td>
      <td>".$user['Article_NO']."</td>
      <td>".$user['Size']."</td>
      <td>".$user['Color']."</td>
      <td>".$user['Gender']."</td>
      <td>".$user['Price']."</td>
      <td>".$user['Branch']."</td>
      </tr>
      </table>";

    
    }
}
}
}
  
//SEARCHING THEN MODIFYING (UPDATING) IN HQ DB
  $user_check_query = "SELECT * FROM inventory WHERE Product_ID='$Pno' AND Branch='Faisalabad'" ;
  $result = mysqli_query($dbHQ, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  if ($user) { // if Pno exists
  //Update Data if no Error
  if (count($errors) == 0) {
    $query = "UPDATE inventory SET Product_ID ='$Pno',Article_No='$Ano',Size='$SIZE',Color='$COLOR',Gender='$GENDER',Price='$PRICE',Branch='$BRANCH'
    WHERE Branch='Faisalabad' AND Product_ID ='$Pno'";
    mysqli_query($dbHQ, $query);

    
}
}

  
  else{
    echo "The data you are trying to MODIFY doesnot exists";
  }
}}//END OF MODIFICATION