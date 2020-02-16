<?php header('Content-Type: application/json');
$watch_id = $_GET['id'];
//echo $watch_id;
//die();
try {
$jsonyt = file_get_contents('https://invidio.us/api/v1/videos/'.$watch_id);
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
  "video" : {
    "video_id" : "1234",
    "url" : "<?=$watch_id?>",
    "full_url" : "https://vidd.la/<?=$watch_id?>",
    "embed_url" : "https://vidd.la/e/<?=$watch_id?>",
    "complete" : "1234.mp4",
    "complete_url" : "<?=$finalplay;?>",
    "state" : "stored",
    "title" : "<?=$infoyt->title;?>",
    "description" : <?=json_encode($infoyt->description);?>,
    "duration" : <?=$infoyt->lengthSeconds;?>,
    "height" : 360,
    "width" : null,
    "date_created" : "<?php echo gmdate("Y-m-d\ H:i:s", $infoyt->published); ?>",
    "date_stored" : "<?php echo gmdate("Y-m-d\ H:i:s", $infoyt->published); ?>",
    "date_completed" : "<?php echo gmdate("Y-m-d\ H:i:s", $infoyt->published); ?>",
    "comment_count" : 0,
    "view_count" : 1,
    "version" : 2,
    "nsfw" : false,
    "thumbnail" : null,
    "thumbnail_url" : <?=json_encode($infoyt->videoThumbnails[2]->url);?>,
    "score" : 1
  },
  "progress" : {
    "progress" : 0.5
  }
}
