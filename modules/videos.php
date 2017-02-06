<?php
use DiDom\Document;
use AnimeGT\AnimeGT\Videos;
use AnimeGT\AnimeGT\VideosQuery;
$app->get('/videos/{id}/{vid}/{aurl}/{eurl}/', function ($request, $response, $args)
{
    $resdata = [];
    $url = "https://api.animeflv.me/?id=".$args['id']."&ep_id=".$args['vid']."&anime=".$args['aurl']."&episode=".$args['eurl'];
    $reshtml = getPage2 ($url);
    $dom = new Document($reshtml);
    echo $reshtml;
    exit;
    $vurl = $dom->find('#divDownload');
    print_r($vurl);
    $response->write(json_encode($resdata));
    return $response;
});
