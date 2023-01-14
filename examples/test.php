<?php

$file = file_get_contents('../test.json');

/*$data = strpos($file,"6 haneli kodu");
var_dump($data);*/

preg_match('/{\\\\\\\(.*?)pk(.*?)}/m',$file,$matches);
print_r(json_decode(str_replace('\\','',$matches[0]),true));