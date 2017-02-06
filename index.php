<?php
//show error_get_last
//http://stackoverflow.com/questions/18382740/cors-not-working-php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Max-Age: 86400');    // cache for 1 day

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}

header("Content-Type: application/json");
require_once 'vendor/autoload.php';

use Propel\Runtime\Propel;
include("generated-conf/config.php");

use DiDom\Document;
use AnimeGT\AnimeGT\Videos;
use AnimeGT\AnimeGT\VideosQuery;



// Include the library..
require_once "getpage.php";
$app = new Slim\App();

// include all modules
foreach (glob("modules/*.php") as $filename)
{
    include $filename;
}

$app->run();
