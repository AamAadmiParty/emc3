<?php
if ($_SERVER["HTTP_HOST"] == 'localhost')  // localhost live environment
{ 
    define('DB_SERVER', 'localhost');
    define('DB_SERVER_USERNAME', 'dummy');
    define('DB_SERVER_PASSWORD', 'dummy');
    define('DB_DATABASE', 'dummy');
}
else 
{ 
    define('DB_SERVER', 'localhost');
    define('DB_SERVER_USERNAME', 'dummy');
    define('DB_SERVER_PASSWORD', 'dummy');
    define('DB_DATABASE', 'dummy');
}

$mysqli = mysqli_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE);

/* check connection */
if (mysqli_connect_errno()) {
echo '<div id="wrapper" style="width:100%; text-align:center">
<img id="yourimage" src="/images/error.jpg"/>
</div>';
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
} 
?>
