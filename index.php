<?php

/*
  KiPhoto - New Generation of the Web Gallery
  vers. 0.2.4 - January 2014

  From an idea of Gianluigi 'A35G' Maurilio
  http://www.hackworld.it/ - http://www.gmcode.it/

  Dedicated to a person to whom I have always given so much with all my might
  Because people are not ever forget
*/

  include_once('inc/config.php');

  //echo $bsc->readFolder();
  echo $bsc->genTemplate($ts, 'tpl/index.html');