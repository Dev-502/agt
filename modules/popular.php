<?php
use DiDom\Document;
use AnimeGT\AnimeGT\Videos;
use AnimeGT\AnimeGT\VideosQuery;
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
      $aimg = str_replace("http://animeflv.me/","https://api.animegt.net/",$aimg);
      $animeurl = str_replace("http://animeflv.me","",$links[0]->href);
      $episodeurl = str_replace("http://animeflv.me","",$links[1]->href);
      array_push($resdata, ['anime_title'=>$links[0]->text(), 'anime_url'=>$animeurl,'episode_title'=>$links[1]->text(),'episode_url'=>$episodeurl,'img'=>$aimg]);
    }
  }

  //$response->write(json_encode($imgs));
  $response->write(json_encode($resdata));
  return $response;
});
