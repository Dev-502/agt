<?php
use DiDom\Document;
use AnimeGT\AnimeGT\Videos;
use AnimeGT\AnimeGT\VideosQuery;
$app->get('/Ver/{vid}/{aurl}/{eurl}/', function ($request, $response, $args)
{
    $alreadyStored = false;
    $someDataStored = false;
    $video = VideosQuery::create()
      ->filterByEid($args['vid'])
      ->filterByUrl($args['aurl'])
      ->filterByEpisode($args['eurl'])
      ->findOne();
    $video = null;
    if($video!=null){
      if(!empty($video->getQ1080())){
        $alreadyStored = true;
      }
      else{
        $someDataStored = true;
      }
    }
    else{
      $video = new Videos();
      $video->setEid($args['vid']);
      $video->setUrl($args['aurl']);
      $video->setEpisode($args['eurl']);
    }
    $resdata = [];
    $gvideos = array();
    if(!$alreadyStored){
      $url = "/Ver/".$args['vid']."/".$args['aurl']."/".$args['eurl'];
      $reshtml = getPage($url);
      $dom = new Document($reshtml);
      $dom->load($reshtml);
      $url2= $dom->find('iframe')[0]->src;
      //$resdata['videoframe'] = $url2;
      $resurl = parse_url($url2)['query'];
      parse_str($resurl,$params_arr);
      $url2="http://player.animeflv.me//blocks/getdownload.php";
      $reshtml2 = postPage($url2,$params_arr['id']);
      //echo $reshtml2;exit;
      $dom2 = new Document($reshtml2);
      //$dom2->load($reshtml2);
      $resdata3 = $dom2->find('a');
      foreach($resdata3 as $itemdata)
      {
      	array_push($gvideos,['name'=>$itemdata->text(),'url'=>$itemdata->href]);
        if($itemdata->text()=='360p'){
          $video->setQ360($itemdata->href);
        }
        if($itemdata->text()=='480p'){
          $video->setQ480($itemdata->href);
        }
        if($itemdata->text()=='720p'){
          $video->setQ720($itemdata->href);
        }
        if($itemdata->text()=='1080p'){
          $video->setQ1080($itemdata->href);
        }
      }
      if(empty($gvideos)){
        $alreadyStored = true;
      }
      else{
        $video->save();
      }
    }
    if($alreadyStored){
      /**
      * si ya se han almacenado los datos
      **/
      if(!empty($video->getQ360())){
        array_push($gvideos,['name'=>'360p','url'=>$video->getQ360()]);
      }
      if(!empty($video->getQ480())){
        array_push($gvideos,['name'=>'480p','url'=>$video->getQ480()]);
      }
      if(!empty($video->getQ720())){
        array_push($gvideos,['name'=>'720p','url'=>$video->getQ720()]);
      }
      if(!empty($video->getQ1080())){
        array_push($gvideos,['name'=>'1080p','url'=>$video->getQ1080()]);
      }
    }
    $resdata['videos'] = $gvideos;
  $response->write(json_encode($resdata));
  return $response;
});
