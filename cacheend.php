<?php

$c = ob_get_contents();
ob_end_flush();

if (!is_dir('cache')) {
  mkdir('cache', 0777, true); // create cache directory if it doesn't exist
}

file_put_contents($cachefile, $c);

?>
