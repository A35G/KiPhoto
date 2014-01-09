<?php

  function getPth($polar='') {

    $fin = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') ? "\\" : "/";

    $len_s = strlen(__DIR__);
    $num_p = strrpos(__DIR__, $fin);

    $pathy = ($len_s != $num_p) ? __DIR__ . $fin : __DIR__;

    $prc = (empty($polar)) ? str_replace("lib".$fin, "", $pathy) : $fin;

    return $prc;

  }

  $path_page = getPth();
  $sngsl = getPth(1);