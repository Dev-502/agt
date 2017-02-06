<?php
use DiDom\Document;
use AnimeGT\AnimeGT\Videos;
use AnimeGT\AnimeGT\VideosQuery;
$app->get('/genere/{query}/{page}', function($request, $response,$args){
  $query = $args['query'];
  $page = (int)$args['page'];
  $resdata = [];
  $resanime = [];
  $url="/genero/".$query."?page=".$page;
  $reshtml = getPage($url);
  $dom = new Document($reshtml);
  $elementos = $dom->find('td');
  foreach ($elementos as $key => $elemento) {
    $elemento_html= urldecode(htmlspecialchars_decode ($elemento->html()));
    # code...
    $tmp = new Document($elemento->html());

    $pattern = '~(http.*\.)(jpe?g|png|[tg]iff?|svg)~i';

    $m = preg_match_all($pattern,$elemento_html,$matches);

    $aimg = $matches[0][0];

    $links = $tmp->find('a');

    //print_r($links);
    $tmp_arr = array();
    if(count($links)>0 and !empty($aimg)){
      $animeurl =  $links[0]->href;
      //replace data
      $aimg = str_replace("http://animeflv.me/","https://api.animegt.net/",$aimg);
      $animeurl = str_replace("http://animeflv.me","",$links[0]->href);
      $episodeurl = str_replace("http://animeflv.me","",$links[1]->href);
      array_push($resanime, ['anime_title'=>$links[0]->text(), 'anime_url'=>$animeurl,'img'=>$aimg]);
    }

  }
  $resdata['results']= $resanime;
  $resdata['page']= $page;
  //$resdata['last'] = 20;
  $response->write(json_encode($resdata));
  return $response;
});
