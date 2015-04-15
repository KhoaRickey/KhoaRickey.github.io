<?php

require_once __DIR__.'/../vendor/autoload.php';
use Symfony\Component\HttpFoundation\Request;
$app = new Silex\Application();

$server   = "khoanickey.ipt.oamk.fi";
$database = "RESTAPI";
$username = "user";
$password = "binbo244";

$mysqlConnection = mysql_connect($server, $username, $password);
if (!$mysqlConnection)
{
  echo "Please try later.";
}
else
{
mysql_select_db($database, $mysqlConnection);
	echo "helolo";
}

$app->get('/hello', function(Silex\Application $app) {
	$data = array("cars" => array ("volvo" => 50,
									"saab" => 10,
									"bmw" => "examplestring"	));
    //return 'Hello!';
	return $app -> json($data);
});

$app -> post('/postRoute', function(Request $request) {
	//$d = print_r($request -> getContent());
	$data = json_decode($request -> getContent());
	
	//return print_r($data);
	$exampleValue1 = $data->dataExample;
	return "value of the dataExample is" . $exampleValue1;
});

$app->get('/dynamictest/{param1}/{param2}', function ($param1, $param2) {
		return "Routing test parameter 1 is " . $param1 . " is " . $param2;
});

$app->run();
