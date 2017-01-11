<?php


//show error_get_last
//http://stackoverflow.com/questions/18382740/cors-not-working-php
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}
header("Content-Type: application/json");


require 'vendor/autoload.php';

// Include the library..
require_once "getpage.php";

use DiDom\Document;


$app = new Slim\App();

$app->get('/test', function ($request, $response, $args)
{
  $resdata = "test";
  $response->write($resdata);
  return $response;
});

$app->get('/new', function ($request, $response, $args)
{
  $resdata = [];
  //$dom = new Dom;
  $url = "/ListadeAnime/NuevoYCaliente";
  $reshtml = getPage($url);
  //$dom->load($reshtml);
  $dom = new Document($reshtml);
  $elementos = $dom->find('tr');
  //echo count($resdata);
  foreach($elementos as $elemento)
  {
    $tmp = new Document($elemento->html());
    $tds = $tmp->find('td');
    $links = $tmp->find('a');
    $tmp_arr = array();
    if(count($links)>=2){
      $tds_img = $tds[0]->title;
      $tmp_img = new Document($tds_img);
      $aimg = $tmp_img->find('img')[0]->src;
      //$aimg = str_replace("http://animeflv.me","api",$tmp_img->find('img')[0]->src);
      //$aimg = str_replace(".jpg","",$aimg);
      $animeurl = str_replace("http://animeflv.me","",$links[0]->href);
      $episodeurl = str_replace("http://animeflv.me","",$links[1]->href);
      array_push($resdata, ['anime_title'=>$links[0]->text(), 'anime_url'=>$animeurl,'episode_title'=>$links[1]->text(),'episode_url'=>$episodeurl,'img'=>$aimg]);
    }
  }

  //$response->write(json_encode($imgs));
  $response->write(json_encode($resdata));
  return $response;
});


$app->get('/popular', function ($request, $response, $args)
{
  $resdata = [];
  //$dom = new Dom;
  $url = "/ListadeAnime/MasVisto";
  $reshtml = getPage($url);
  //$dom->load($reshtml);
  $dom = new Document($reshtml);
  $elementos = $dom->find('tr');
  //echo count($resdata);
  foreach($elementos as $elemento)
  {
    $tmp = new Document($elemento->html());
    $tds = $tmp->find('td');
    $links = $tmp->find('a');
    $tmp_arr = array();
    if(count($links)>=2){
      $tds_img = $tds[0]->title;
      $tmp_img = new Document($tds_img);
      $aimg = $tmp_img->find('img')[0]->src;
      $animeurl = str_replace("http://animeflv.me","",$links[0]->href);
      $episodeurl = str_replace("http://animeflv.me","",$links[1]->href);
      array_push($resdata, ['anime_title'=>$links[0]->text(), 'anime_url'=>$animeurl,'episode_title'=>$links[1]->text(),'episode_url'=>$episodeurl,'img'=>$aimg]);
    }
  }

  //$response->write(json_encode($imgs));
  $response->write(json_encode($resdata));
  return $response;
});





$app->get('/Anime/{aid}/{aurl}/', function ($request, $response, $args)
{
    $resdata = [];
    //$dom = new Dom;
    $url = "/Anime/".$args['aid']."/".$args['aurl'];
    $reshtml = getPage($url);
    //$dom->load($reshtml);
    $dom = new Document($reshtml);
    $resdata['title'] = ($dom->find('.bigChar')[0]->text());
    $resdata['title2'] = (str_replace('Otro Nombre:','',trim($dom->find('p')[2]->text())));
//    $resdata['generos']= utf8_decode($resdata['title2']);
    $resdata['url'] = str_replace('http://animeflv.me','',$dom->find('.bigChar')[0]->href);
    $resdata['info'] = trim(explode($dom->find('p')[3]->text(),"\r\n")[0]);
    $resdata['description'] = trim($dom->find('p')[5]->text());
    if(strlen($resdata['description'])<=24){$resdata['description'] = trim($dom->find('p')[6]->text());}
    //div.rightBox:nth-child(1) > div:nth-child(2) > div:nth-child(2) > img:nth-child(1)
    //div.rightBox > div:nth-child(2) > div:nth-child(2) > img:nth-child(1)
    $dta_img =$dom->find('.rightBox img');
    foreach($dta_img as $key =>$itimg){
    	$resdata['img']= $itimg->src;
    	break;
    }
    $capitulos = $dom->find('tr');
    $count = 0;
    foreach($capitulos as $key => $capitulo)
    {
        if($key==0){continue;}
        //echo $capitulo->text();
        $tmp = new Document($capitulo->html());
        $links = $tmp->find('a');
        if($links[0]->href != null){
            $resdata['capitulos'][$count]['url']= str_replace('http://animeflv.me','',$links[0]->href);
            $resdata['capitulos'][$count]['title']= $links[0]->text();
            $count ++;
        }
        
    }
  $response->write(json_encode($resdata));
  return $response;
});





$app->get('/Ver/{vid}/{aurl}/{eurl}/', function ($request, $response, $args) 
{
    $resdata = [];
    $url = "/Ver/".$args['vid']."/".$args['aurl']."/".$args['eurl'];
    $reshtml = getPage($url);
    $dom = new Document($reshtml);
    $dom->load($reshtml);
    $url2= $dom->find('iframe')[0]->src;
    $resdata['videoframe'] = $url2;
    $resurl = parse_url($url2)['query'];
    parse_str($resurl,$params_arr);
    $url2 = "/api/videos/".$params_arr['id']."/".$params_arr['ep_id']."/".$params_arr['anime']."/".$params_arr['episode'];
    //$url2  ="http://cproxy.io.gt/?id=".$params_arr['id']."&ep_id=".$params_arr['ep_id']."&anime=".$params_arr['anime']."&episode=".$params_arr['episode'];
    //echo $url2;
   //echo $url2;exit;
    //$reshtml2 = getPage($url2);
    $url2="http://player.animeflv.me//blocks/getdownload.php";
    $reshtml2 = postPage($url2,$params_arr['id']);
    //echo $reshtml2;exit;
    $dom2 = new Document($reshtml2);
    //$dom2->load($reshtml2);
    $resdata3 = $dom2->find('a');
    $gvideos = array();
    foreach($resdata3 as $itemdata)
    {
    	array_push($gvideos,['name'=>$itemdata->text(),'url'=>$itemdata->href]);
    }
    $resdata['videos'] = $gvideos;
  $response->write(json_encode($resdata));
  return $response;
});

$app->get('/videos/{id}/{vid}/{aurl}/{eurl}/', function ($request, $response, $args) 
{
    $resdata = [];
    $url = "http://api.animeflv.me/?id=".$args['id']."&ep_id=".$args['vid']."&anime=".$args['aurl']."&episode=".$args['eurl'];
    $reshtml = getPage2 ($url);
    $dom = new Document($reshtml);
    echo $reshtml;
    exit;
    $vurl = $dom->find('#divDownload');
    print_r($vurl);
    $response->write(json_encode($resdata));
    return $response;
});




$app->get('/uploads/{ftype}/{filename}', function ($request, $response, $args)
{
  //$cloudflare = new \Stack\Bypass\CloudFlare("http://animeflv.me", [true, "faggot.txt"]);
  $url = "/uploads/".$args['ftype']."/".$args['filename'];
  $data = base64_encode(getImage($url));
  //$type = "image/jpg";
  //header("Content-type:".$type);
  //echo data;

$imageSave = imagejpeg($rotated_img, $file, 10);

imagedestroy($source_img);
  //$resdata = '<img src="data:image/gif;base64,' . $resdata . '" />';
  //$response->write($resdata);
  //return $response;
});

$app->get('/hello/{name}', function ($request, $response, $args) {
    $response->write("Hello, " . $args['name']);
    return $response;
});

$app->run();
