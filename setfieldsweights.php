<?php

require_once './others/sphinxapi.php';

$cl = new SphinxClient();
$cl->SetServer('localhost', 19312);
$cl->SetFieldWeights(array('title' => 15000, 'content' => 30000));
$cl->SetMatchMode(SPH_MATCH_EXTENDED);
$r = $cl->Query('test');
var_dump($r);
