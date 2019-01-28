<?php 
function getUserIP()
{
    // Get real visitor IP behind CloudFlare network
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
              $_SERVER['REMOTE_ADDR'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
              $_SERVER['HTTP_CLIENT_IP'] = $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    return $ip;
}


$user_ip = getUserIP();

if($user_ip === '::1')
{
    include('checkBranch.php');
}

elseif($user_ip === '192.168.43.94')
{
    
    if(isset($_POST['replicateInsert'])){
        include("../salesAsyncho/server3asyncho.php");

    }
    elseif(isset($_POST['replicateDelete'])){
        include("../salesAsyncho/server3asyncho.php");

    }
    elseif(isset($_POST['replicateModify'])){
        include("../salesAsyncho/server3asyncho.php");

    }
    
}

elseif($user_ip === '192.168.43.21')
{
    if(isset($_POST['replicateInsert'])){
        include("../salesAsyncho/server2asyncho.php");

    }
    
    elseif(isset($_POST['replicateDelete'])){
        include("../salesAsyncho/server2asyncho.php");

    }
    elseif(isset($_POST['replicateModify'])){
        include("../salesAsyncho/server2asyncho.php");

    }
}

?>