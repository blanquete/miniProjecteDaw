<?php


if(isset($_POST))
{
    echo "Hi ha Post<br>";
    echo count($_POST) . "<br>";
    print_r($_POST);
}
else
{
    echo "NO hi ha Post<br>";
}


echo "<br><br><br>";


if(isset($_GET))
{
    echo "Hi ha Get<br>";
    echo count($_GET) . "<br>";
    print_r($_GET);
}
else
{
    echo "NO hi ha Get<br>";
}


echo "<br><br><br>";


if(isset($_REQUEST))
{
    echo "Hi ha Request<br>";
    echo count($_REQUEST) . "<br>";
    print_r($_REQUEST);
}
else
{
    echo "NO hi ha Request<br>";
}


echo "<br><br><br>";


echo $_SERVER['REQUEST_METHOD'];


echo "<br><br><br>";


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

foreach($uri as $u)
{
    echo $u . "<br>";
}

echo "<br><br><br>";


//print_r($_SERVER);

?>