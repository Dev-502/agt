<?php
use DiDom\Document;
use AnimeGT\AnimeGT\Videos;
use AnimeGT\AnimeGT\VideosQuery;
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
    $resdata['img'] = str_replace("http://animeflv.me/","https://api.animegt.net/",$resdata['img']);
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
