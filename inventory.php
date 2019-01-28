<?php include('IPchecking.php');?>
<html>
<head>
  <title>EasyWalk</title>
  <link rel="stylesheet" href="CSS/index.css"> 
</head>
<body>
    <?php
    
      if($user_ip !== '::1'){
         echo "<a href='index.php' class='mainpage'>Change Method</a>";
      }
      ?>
    <div class="Tables">
        <img src="Images/logo.png" width="520" height=""/>
        <ul class="tabs">
          <li class="tab active"><a href="#content">Inventory</a></li>
          <li class="tab"><a href="Sales.php">Sales</a></li>
        </ul>
          <div id="content">   
            
            <table>
                <tr>
                    <td><a href="Inventory/insert.php">- Insert</a></td>
                </tr>
                
                <tr>
                    <td><a href="Inventory/search.php">- Search</a></td>
                </tr>
                
                <tr>
                    <td><a href="Inventory/modify.php">- Modify</a></td>
                </tr>
                <tr>
                    <td><a href="Inventory/delete.php">- Delete</a></td>
                </tr>
                <tr>
                    <td><a href="Inventory/showall.php">- Show All</a></td>
                </tr>
            </table>  
            <h1>Inventory Table</h1>
        </div>
      </div> 
</body>
</html>