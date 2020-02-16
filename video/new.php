<?php header('Content-Type: application/json');
$getoffset = $_GET['offset'];
$getlimit = $_GET['limit'];
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
  $wchpg_userurl = $infoyt->authorId;
  $wchpg_title = $infoyt->title;
  $wchpg_displayname = $infoyt->author;
  $wchpg_uploaddate_bin = $infoyt->published;
  $wchpg_uploaddate = date('M j, Y',strtotime("@".$infoyt->published));
  //$wchpg_uploaddate = date('Y-m-d', $infoyt->published);
  $wchpg_longdesc = $infoyt->descriptionHtml;
  $wchpg_category = $infoyt->genre;
  $wchpg_avatar = $infoyt->authorThumbnails[3]->url;
  $wchpg_thumb = $infoyt->videoThumbnails[2]->url;
  $wchpg_viewcount = $infoyt->viewCount;
  $wchpg_upvcount = $infoyt->likeCount;
  $wchpg_dwnvcount = $infoyt->dislikeCount;
  //$wchpg_tags = $infoyt->keywords;
  $wchpg_tags = implode(", ",$infoyt->keywords);

  foreach ($infoyt->formatStreams as $vidsrc) {
    $finalplay = $vidsrc->url;
    $finalh = $vidsrc->qualityLabel;
 }
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
$vtcurrent = 0;
foreach ($infoyt as $vidtrend) {
    $vtcurrent = $vtcurrent + 1;
        echo "
        $vtcurrent {
        \"video_id\" : \"$watch_id\",
        \"url\" : \"https://vidd.la/$watch_id\",
        \"complete\" : \"$finalplay;\",
        \"state\" : \"stored",
        \"title\" : \"$infoyt->title;\",
        \"description\" : json_encode($infoyt->description);,
        \"duration\" : $infoyt->lengthSeconds;,
        \"height\" : 360,
        \"width\" : null,
        \"date_created\" : \"".gmdate("Y-m-d\ H:i:s", $infoyt->published);."\",
        \"date_stored\" : \"".gmdate("Y-m-d\ H:i:s", $infoyt->published);."\",
        \"date_completed\" : \"".gmdate("Y-m-d\ H:i:s", $infoyt->published);."\",
        \"comment_count\" : \"0",
        \"view_count\" : \"1",
        \"version\" : 2,
        \"nsfw\" : 0,
        \"thumbnail\" : ".json_encode($infoyt->videoThumbnails[2]->url);.",
        \"score\" : 10,
            \"user\" : {
                \"user_id\" : "",
                \"username\" : "",
                \"full_url\" : "",
                \"avatar\" : "",
                \"avatar_url\" : ""
                }
            }"

    					      }
                          ?>
        }
}