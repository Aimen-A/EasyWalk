<?php include('checkIP.php')?>
<!DOCTYPE html>
<html>
<head>
<title>DeleteSales</title>
<link rel="stylesheet" href="../CSS/pages.css"> 
</head>
<body>
    <a href="../sales.php" class="header">GOTO MAIN MENU</a>
    <form action='delete.php' method='POST'> 
        <h1>Delete</h1>
        <table>
            <tr>
                <td>Enter Product No to Delete</td>
                <td><input type="text" name="pNo" required autocomplete="off"/></td>
            </tr>
            
        <?php
            if($user_ip === '::1')
            {
                echo"
                <tr>
                <td>Branch</td>
                <td><input type='radio' name='branch' value='Karachi' checked='checked'> Karachi<br>
                    <input type='radio' name='branch' value='Lahore'> Lahore<br>
                    <input type='radio' name='branch' value='Faisalabad'> Faisalabad<br ><td>
                </tr>";
            }
        ?>
            <tr>
                <td><button type="submit" name='salesDelete'class="button">Delete</button></td>
            </tr>
        </table>
    </form>

    <?php
        if($user_ip === '192.168.43.94'){
                    
            $db = mysqli_connect('192.168.43.94','EasyWalk3','easywalk3','method');
                    
                $user_check_query = "SELECT *FROM method_type ORDER BY ID DESC LIMIT 1";
                $result = mysqli_query($db, $user_check_query);
                $user = mysqli_fetch_assoc($result);
                
                if($user) 
                { 
                    $method = $user['Name_Method'];
                
                    if($method=='asyncho'){
                        echo "
                        <form class='noStyle' action='delete.php' method='POST'>
                        <button type='submit' name='replicateDelete' class='replicate'>Replicate in HQ</button>
                        </form>";

                        include("../salesAsyncho/server3tempo.php");

                    }
                    if($method=='syncho'){
                               
                        include("server3.php");
                    }

                }
                else
                {
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
                        $method = $user['Name_Method'];
                        if($method=='asyncho'){
                            echo "
                            <form class='noStyle' action='delete.php' method='POST'>
                            <button type='submit' name='replicateDelete' class='replicate'>Replicate in HQ</button>
                            </form>";

                        include("../salesAsyncho/server2tempo.php");
                        }
                        if($method=='syncho'){
                        
                            include("server2.php");
                        }

                    }
                    else
                    {
                        header("location:../index.php");
                    }
        }
    ?>

</body>
