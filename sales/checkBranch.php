<?php
if(isset($_POST['salesInsert'])){
    $BRANCH =$_POST['branch'];
    if($BRANCH=='Karachi')
    {
        include("server.php");
    }
    elseif($BRANCH=='Lahore')
    {
        include("server2.php");
    }
    elseif($BRANCH=='Faisalabad')
    {
        include("server3.php");
    }
}

if(isset($_POST['salesSearch'])){
    $BRANCH=$_POST['branch'];
    if($BRANCH=='Karachi')
    {
        include("server.php");
    }
    elseif($BRANCH=='All')
    {
        include("server.php");
    }
    elseif($BRANCH=='Lahore')
    {
        include("server2.php");
    }
    elseif($BRANCH=='Faisalabad')
    {
        include("server3.php");
    }
}

if(isset($_POST['salesDelete'])){
    $BRANCH =$_POST['branch'];
    if($BRANCH=='Karachi')
    {
        include("server.php");
    }
    elseif($BRANCH=='Lahore')
    {
        include("server2.php");
    }
    elseif($BRANCH=='Faisalabad')
    {
        include("server3.php");
    }
}

if(isset($_POST['salesModify'])){
    $BRANCH =$_POST['branch'];
    if($BRANCH=='Karachi')
    {
        include("server.php");
    }
    elseif($BRANCH=='Lahore')
    {
        include("server2.php");
    }
    elseif($BRANCH=='Faisalabad')
    {
        include("server3.php");
    }
}
       
if(isset($_POST['salesShow'])){
    $BRANCH ='Karachi';
    include("server.php");
}

?>
