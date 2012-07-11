<?php
$pathinfo=pathinfo($_ENV['SCRIPT_FILENAME']);
$extension=$pathinfo['extension'];
$offset = 60 * 60 * 24 * 7;
if($extension=='css'){
header('Content-type: text/css; charset=utf-8');
header('Content-Encoding: gzip');
}
if($extension=='js'){
header('Content-type: text/javascript; charset=utf-8');
header('Content-Encoding: gzip');
}
header("Expires: ".gmdate("D, d M Y H:i:s", time() + $offset)." GMT");
header('Vary: Accept Encoding');
header('Cache-control: public');
?>