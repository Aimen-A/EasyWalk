<?php include('checkIP.php')?>
<!DOCTYPE html>
<html>
<head>
<title>SearchSales</title>
<link rel="stylesheet" href="../CSS/pages.css"> 
</head>
<body>
<a href="../sales.php" class="header">GOTO MAIN MENU</a>
    <form action='search.php' method='POST'> 
        <h1>Search</h1>
        <table>
        
        <?php
        
            if($user_ip === '::1')
            {
                echo"
                <tr>
                <td>Branch</td>
                <td><input type='radio' name='branch' value='Karachi' checked='checked'> Karachi<br>
                    <input type='radio' name='branch' value='Lahore'> Lahore<br>
                    <input type='radio' name='branch' value='Faisalabad'> Faisalabad<br>
                    <input type='radio' name='branch' value='All'> All</td>
                </tr>";
            }
            
        ?>
            <tr>
                <td>Product No</td>
                <td><input type="text" name="pNo" required autocomplete="off"/></td>
            </tr>
            
            <tr>
                <td><button type="submit" name='salesSearch'class="button">Search</button></td>
            </tr>
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
