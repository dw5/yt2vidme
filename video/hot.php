<?php header('Content-Type: application/json');
//$getoffset = $_GET['offset'];
//$getlimit = $_GET['limit'];
try {
$jsonyt = file_get_contents('https://invidio.us/api/v1/trending/');
//.'?fields=authorId,author,title,genre,description,descriptionHtml,published,authorThumbnails,videoThumbnails,viewCount,likeCount,dislikeCount,keywords,dashUrl,formatStreams,hlsUrl&pretty=1');

if ($jsonyt === false) {
// Handle Error
echo "
{
  \"status\" : false,
  \"error\" : \"Video not found\",
  \"code\" : \"video_not_found\"
}
";

} else {
  $infoyt = json_decode($jsonyt, false);
/*
  foreach ($infoyt->formatStreams as $vidsrc) {
    $finalplay = $vidsrc->url;
    $finalh = $vidsrc->qualityLabel;
 }*/
}
}
catch(Exception $e) {
  // Handle the Exception
  echo "Viddla MEModeEmu Core Error: " . $e->getMessage();
  die();
}
?>
<?php /*
$myObj->name = "John";
$myObj->age = 30;
$myObj->city = "New York";

$myJSON = json_encode($myObj);

echo $myJSON; */
?>
{
"status" : true,
    "page" : {
        "total" : 
        "limit" : 
        "offset" : 
    }
<?php

        /*
        $vidtrend->title; 
        $vidtrend->videoId;
        $vidtrend->authorId;
        $vidtrend->description;
        $vidtrend->viewCount;
        $vidtrend->published;
        $vidtrend->lengthSeconds;
        $vidtrend->videoThumbnails[2]->url; */
?>

"videos" : {
    <?php
$vtcurrent = -1;
foreach ($infoyt as $vidtrend) {
    $vtcurrent = $vtcurrent + 1;
    $vidtrenddummymp4 = "https://vidd.la/cdn/video/vid1.mp4";
        echo "
        $vtcurrent : {
        \"video_id\" : \"".$vidtrend->videoId."\",
        \"url\" : \"https://vidd.la/".$vidtrend->title."\",
        \"complete\" : \"".$vidtrenddummymp4."\",
        \"state\" : \"stored\",
        \"title\" : \"".$vidtrend->title."\",
        \"description\" : ".json_encode($vidtrend->description).",
        \"duration\" : ".$vidtrend->lengthSeconds.",
        \"height\" : 360,
        \"width\" : null,
        \"date_created\" : \"".gmdate("Y-m-d\ H:i:s", $vidtrend->published)."\",
        \"date_stored\" : \"".gmdate("Y-m-d\ H:i:s", $vidtrend->published)."\",
        \"date_completed\" : \"".gmdate("Y-m-d\ H:i:s", $vidtrend->published)."\",
        \"comment_count\" : 0,
        \"view_count\" : 1,
        \"version\" : 2,
        \"nsfw\" : 0,
        \"thumbnail\" : ".json_encode($vidtrend->videoThumbnails[2]->url).",
        \"score\" : 10,
            \"user\" : {
                \"user_id\" : \"".$vidtrend->authorId."\",
                \"username\" : \"".$vidtrend->authorId."\",
                \"full_url\" : \"https://".$vidtrend->authorId."\",
                \"avatar\" : ".json_encode($vidtrend->videoThumbnails[2]->url).",
                \"avatar_url\" : ".json_encode($vidtrend->videoThumbnails[2]->url)."
                }
            }
            ";

    					      }?>
                          
        }
}