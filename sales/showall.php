<?php include('checkIP.php')?>
<!DOCTYPE html>
<html>
<head>
<title>ShowInventory</title>
<link rel="stylesheet" href="../CSS/pages.css"> 
</head>
<body>
<a href="../sales.php" class="header">GOTO MAIN MENU</a>
    <form action='showAll.php' method='POST'> 
        <h1>Show ALL</h1>
        <table>
            <tr>
                <td><button type="submit" name='salesShow'class="button">Show ALL</button></td>
            </tr>
            
    <?php
          
        if($user_ip === '::1')
        {
            if(isset($_POST['salesShow'])){
                $BRANCH ='Karachi';}
        }
    ?>
        </table>
    </form>
    
    <?php
            
            if($user_ip === '192.168.43.94'){
            
                $db = mysqli_connect('192.168.43.94','EasyWalk3','easywalk3','method');
                    
                    $user_check_query = "SELECT *FROM method_type ORDER BY ID DESC LIMIT 1";
                    $result = mysqli_query($db, $user_check_query);
                    $user = mysqli_fetch_assoc($result);

                    if($user){
                        include("server3.php");
                    }

                    else{
                        header("location:../index.php");
                    }
            }

            if($user_ip === '192.168.43.21'){
            
                $db = mysqli_connect('192.168.43.21','EasyWalk2','easywalk2','method');
                    
                    $user_check_query = "SELECT *FROM method_type ORDER BY ID DESC LIMIT 1";
                    $result = mysqli_query($db, $user_check_query);
                    $user = mysqli_fetch_assoc($result);
                        
                    if($user) 
                    { 
                        include("server2.php");
                    }
                    else
                    {
                        header("location:../index.php");
                    }
            }
    ?>
</body>
