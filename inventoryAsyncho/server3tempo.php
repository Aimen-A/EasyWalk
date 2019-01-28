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
  

  // first check the database to make sure 
  // PRODUCT not already exist
  
  $user_check_query = "SELECT * FROM inventory WHERE Product_ID='$Pno'" ;
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  if ($user) { // if Pno exists
    if ($user['Product_ID'] === $Pno) {
      array_push($errors, "*Product Already Exist");
      }}

//checking if product exist in temp

  $user_check_query = "SELECT * FROM inventoryasyncho WHERE Product_ID='$Pno'" ;
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  if ($user) { // if Pno exists
    if ($user['Product_ID'] === $Pno) {
      array_push($errors, "*Product Already Exist");
      }}
      //exist in HQ?

  $user_check_query = "SELECT * FROM inventory WHERE Product_ID='$Pno'" ;
  $result = mysqli_query($dbHQ, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  

  if ($user) { // if Pno exists
    if ($user['Product_ID'] === $Pno) {
      array_push($errors, "*Product Already Exist");
      echo "product already exists";}}
      
  
      
     //Finally Insert data if there is no Errors
     if (count($errors) == 0) {
        $query = "INSERT INTO inventory (Product_ID,Article_No,Size,Color,Gender,Price,Branch) 
                  VALUES('$Pno','$Ano', '$SIZE','$COLOR','$GENDER','$PRICE','$BRANCH')";
        mysqli_query($db, $query);
    } 
     //Finally Insert data if there is no Errors
     if (count($errors) == 0) {
      $query = "INSERT INTO inventoryasyncho (Product_ID,Article_No,Size,Color,Gender,Price,Branch) 
                VALUES('$Pno','$Ano', '$SIZE','$COLOR','$GENDER','$PRICE','$BRANCH')";
      mysqli_query($db, $query);
      echo "Data Inserted";
  }
  


  }


  

  //Deleting

  if(isset($_POST['inventoringDelete'])) {
 
    //recieve all inputted walues from the form
    $Pno=mysqli_real_escape_string($db,$_POST['pNo']);
   
    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($Pno)) { array_push($errors, "*Product No is required"); }
  
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


          $Pno=$user['Product_ID'];
          $Ano=$user['Article_NO'];
          $SIZE=$user['Size'];
          $COLOR=$user['Color'];
          $GENDER=$user['Gender'];
          $PRICE=$user['Price'];
          $BRANCH=$user['Branch'];
    
          $query = "INSERT INTO inventoryasyncho (Product_ID,Article_No,Size,Color,Gender,Price,Branch) 
                      VALUES('$Pno','$Ano', '$SIZE','$COLOR','$GENDER','$PRICE','$BRANCH')";
            mysqli_query($db, $query);



      }
    $user_check_query = "Delete FROM inventory WHERE Product_ID='$Pno'" ;
    $result = mysqli_query($db, $user_check_query);
    if($result)
    {
      echo "<br >"."Above Data Deleted successfully"."<br/>"."<hr/>";
    }else{
      echo "<br >"."Above Data Not Deleted successfully"."<br/>"."<hr/>";
    }

  }
    else{
      echo "The data you are trying to DELETE doesnot exists";
    }
  }//end delete



  if(isset($_POST['inventoringDelete'])) {
 
    //recieve all inputted walues from the form
    $Pno=mysqli_real_escape_string($db,$_POST['pNo']);
   
    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($Pno)) { array_push($errors, "*Product No is required"); }
  
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


          $Pno=$user['Product_ID'];
          $Ano=$user['Article_NO'];
          $SIZE=$user['Size'];
          $COLOR=$user['Color'];
          $GENDER=$user['Gender'];
          $PRICE=$user['Price'];
          $BRANCH=$user['Branch'];
    
          $query = "INSERT INTO inventoryasyncho (Product_ID,Article_No,Size,Color,Gender,Price,Branch) 
                      VALUES('$Pno','$Ano', '$SIZE','$COLOR','$GENDER','$PRICE','$BRANCH')";
            mysqli_query($db, $query);



      }
    $user_check_query = "Delete FROM inventory WHERE Product_ID='$Pno'" ;
    $result = mysqli_query($db, $user_check_query);
    if($result)
    {
      echo "<br >"."Above Data Deleted successfully"."<br/>"."<hr/>";
    }else{
      echo "<br >"."Above Data Not Deleted successfully"."<br/>"."<hr/>";
    }

  }
    else{
      echo "The data you are trying to DELETE doesnot exists";
    }
  }

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

  if ($user)  {// if Pno exists
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

    //Inserting Modified record in tempo table
    $query = "INSERT INTO inventoryasyncho (Product_ID,Article_No,Size,Color,Gender,Price,Branch) 
    VALUES('$Pno','$Ano', '$SIZE','$COLOR','$GENDER','$PRICE','$BRANCH')";
    mysqli_query($db, $query);


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

  
  
}
else{
  echo "The data you are trying to MODIFY doesnot exists";
}
}//END OF MODIFICATION


  ?>