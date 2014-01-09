<?php

  define("perc_ext", json_encode(array(".", "..")));
  include('lib/path.php');
  define("root_base", $path_page."gallery".$sngsl);
  define("root_site", "http://localhost/varie/kp/");

  include('inc/kiphoto.class.php');
  $bsc = new Core;

  $ts = array(
    "Url_Gallery" => root_site
  );