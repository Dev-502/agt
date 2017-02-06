<?php
use DiDom\Document;
use AnimeGT\AnimeGT\Videos;
use AnimeGT\AnimeGT\VideosQuery;
$app->get('/uploads/{ftype}/{filename}', function ($request, $response, $args)
{
    $url = "/uploads/".$args['ftype']."/".$args['filename'];
    $image = getImage($url);
    //$response->write($image);
    //return $response;
    //ob_end_clean();
    //imagejpeg($image);
});
