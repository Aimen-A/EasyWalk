<?php

//initializing variables
$Pno="";
$name="";
$date="";
$errors = array();


//connect to the database
$db = mysqli_connect('192.168.43.220','EasyWalk','easywalk','easywalk');

if(isset($_POST['salesInsert'])) {

    //recieve all inputted walues from the form
    $Pno=mysqli_real_escape_string($db,$_POST['pNo']);
    $name=mysqli_real_escape_string($db,$_POST['name']);
    $date=mysqli_real_escape_string($db,$_POST['date']);

    // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($Pno)) { array_push($errors, "*Product No is required"); }
  if (empty($name)) { array_push($errors, "*Name is required"); }
  if (empty($date)) { array_push($errors, "*price is required"); }
  

  // SEEING IF THE PRODUCT TO BE INSERTED IN SALES EXIST IN INVENTORY
  $user_check_query = "SELECT * FROM inventory WHERE Product_ID='$Pno' AND Branch='Karachi'" ;
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if Pno exists
    if ($user['Product_ID'] === $Pno) {
      $price=$user['Price'];
      //IF PRODUCT EXIST IN INVENTORY DELETE IT BECAUSE NOW ITS BEEING SOLD
      $user_check_query = "Delete FROM inventory WHERE Product_ID='$Pno' AND Branch='Karachi'" ;
      $result = mysqli_query($db, $user_check_query);
      if($result)
  {
    echo "<br >"."Product Deleted from inventory"."<br/>";
  }
  else{
    array_push($errors, "*Product doesnot exist");
    
  }
      
     //NOW INSERTING DATA IN SALES
     if (count($errors) == 0) {
        $query = "INSERT INTO sales(Product_ID,CustomerName,dateTrans,Price,Branch) 
                  VALUES('$Pno','$name','$date','$price','Karachi')";
        mysqli_query($db, $query);
        echo "Data inserted in Sales";


}
}}
else{
  echo "Product does not exist in the inventory";
}
}//END OF INSERTION


if(isset($_POST['salesSearch'])) {
 
  //recieve all inputted walues from the form
  $Pno=mysqli_real_escape_string($db,$_POST['pNo']);
 
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($Pno)) { array_push($errors, "*Product No is required"); }

  if($BRANCH==='Karachi'){
  $user_check_query = "SELECT * FROM sales WHERE Product_ID='$Pno' AND Branch='Karachi'" ;
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  }
  else{
    $user_check_query = "SELECT * FROM sales WHERE Product_ID='$Pno'" ;
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    }
  if ($user) { // if Pno exists
    if (count($errors) == 0) {
      echo "<table class='tableheadings'>
      <tr>
      <th>Product_ID</th>
      <th>Customer Name</th>
      <th>Date</th>
      <th>Price</th>
      <th>Branch</th>
      </tr>
      <tr>
      <td>".$user['Product_ID']."</td>
      <td>".$user['CustomerName']."</td>
      <td>".$user['dateTrans']."</td>
      <td>".$user['Price']."</td>
      <td>".$user['Branch']."</td>
      </tr>
      </table>";
    }
  }
  else
  {
    echo "Entered ID doesnot exists"; 
  } 
}

if(isset($_POST['salesModify'])) {
 
  //recieve all inputted walues from the form
  $Pno=mysqli_real_escape_string($db,$_POST['pNo']);
 
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($Pno)) { array_push($errors, "*Product No is required"); }

  $user_check_query = "SELECT * FROM sales WHERE Product_ID='$Pno' AND Branch='Karachi'" ;
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if Pno exists
    if (count($errors) == 0) {
      echo "OLD RECORD"."<br/>";
      echo "<table class='tableheadings'>
      <tr>
      <th>Product_ID</th>
      <th>Customer Name</th>
      <th>Date</th>
      <th>Price</th>
      <th>Branch</th>
      </tr>
      <tr>
      <td>".$user['Product_ID']."</td>
      <td>".$user['CustomerName']."</td>
      <td>".$user['dateTrans']."</td>
      <td>".$user['Price']."</td>
      <td>".$user['Branch']."</td>
      </tr>
      </table>";
    
       //recieve all inputted walues from the form
    $Pno=mysqli_real_escape_string($db,$_POST['pNo']);
    $name=mysqli_real_escape_string($db,$_POST['name']);
    $date=mysqli_real_escape_string($db,$_POST['date']);
    $price=mysqli_real_escape_string($db,$_POST['price']);

    // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($Pno)) { array_push($errors, "*Product No is required"); }
  if (empty($name)) { array_push($errors, "*Name is required"); }
  if (empty($date)) { array_push($errors, "*Date is required"); }
  if (empty($price)) { array_push($errors, "*Price is required"); }
  //Update Data if no Error
  if (count($errors) == 0) {
    $query = "UPDATE sales SET Product_ID ='$Pno',CustomerName='$name',dateTrans='$date',Price='$price'
    WHERE Product_ID ='$Pno'";
    mysqli_query($db, $query);
    echo "<br>"."Data Modified successfully"."<br>";

    $user_check_query = "SELECT * FROM sales WHERE Product_ID='$Pno' AND Branch='Karachi'" ;
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if Pno exists
    if (count($errors) == 0) {
      echo "NEW RECORD"."<br/>";
      echo "<table class='tableheadings'>
      <tr>
      <th>Product_ID</th>
      <th>Customer Name</th>
      <th>Date</th>
      <th>Price</th>
      <th>Branch</th>
      </tr>
      <tr>
      <td>".$user['Product_ID']."</td>
      <td>".$user['CustomerName']."</td>
      <td>".$user['dateTrans']."</td>
      <td>".$user['Price']."</td>
      <td>".$user['Branch']."</td>
      </tr>
      </table>";
    
    }
    echo "<br>"."<br>"."<hr/>";
}
}
}
  }
  else{
    echo "The data you are trying to modify doesnot exists";
  }
}

if(isset($_POST['salesDelete'])) {
 
  //recieve all inputted walues from the form
  $Pno=mysqli_real_escape_string($db,$_POST['pNo']);
 
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($Pno)) { array_push($errors, "*Product No is required"); }
  
  $user_check_query = "SELECT * FROM sales WHERE Product_ID='$Pno' AND Branch='Karachi'" ;
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if Pno exists
    if (count($errors) == 0) {
      echo "<table class='tableheadings'>
      <tr>
      <th>Product_ID</th>
      <th>Customer Name</th>
      <th>Date</th>
      <th>Price</th>
      <th>Branch</th>
      </tr>
      <tr>
      <td>".$user['Product_ID']."</td>
      <td>".$user['CustomerName']."</td>
      <td>".$user['dateTrans']."</td>
      <td>".$user['Price']."</td>
      <td>".$user['Branch']."</td>
      </tr>
      </table>";
    }
  $user_check_query = "Delete FROM sales WHERE Product_ID='$Pno' AND Branch='Karachi'" ;
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
if(isset($_POST['salesShow'])) {
 
  $user_check_query = "SELECT *FROM sales" ;
  $result = mysqli_query($db, $user_check_query);
  $resultChecked=mysqli_num_rows($result);

  if ($resultChecked > 0) { 
    while($rows = mysqli_fetch_assoc($result)) {
      echo "<table class='tableheadings'>
      <tr>
      <th>Product_ID</th>
      <th>Customer Name</th>
      <th>Date</th>
      <th>Price</th>
      <th>Branch</th>
      </tr>
      <tr>
      <td>".$rows['Product_ID']."</td>
      <td>".$rows['CustomerName']."</td>
      <td>".$rows['dateTrans']."</td>
      <td>".$rows['Price']."</td>
      <td>".$rows['Branch']."</td>
      </tr>
      </table>";
    }
  }
  else
  {
    array_push($errors, "No Data Exists"); 
    echo "No Data Exists";
  } 
}