<?php

  require 'autoload.php'; 
  Autoloader::register(); 

  $request_method = $_SERVER["REQUEST_METHOD"];
  $json = file_get_contents('php://input');
  $datajson = json_decode($json);

  switch($request_method)
  {
    case 'POST':
      if(!empty($datajson->name) && $datajson->name === false)
      {
        $control = new Controller();
        $control->SelectVideoControl($datajson->name);
      }
      elseif (!empty($datajson->date) && $datajson->date === true)
      {
        $control = new Controller();
        $control->SelectVideoControlBanner();
      }
      elseif (!empty($datajson->veriftitle))
      {
        $control = new Controller();
        $control->SelectVerificationVideo($datajson->veriftitle);
      }
      elseif (!empty($_POST['usertitle']))
      {
        $chunkid = str_pad($_POST['chunk'],10,"0",STR_PAD_LEFT);
        $config = parse_ini_file("config.ini", true);
        $filePathTmp = $config['config_file']['filePath'];
        file_put_contents($filePathTmp."php".$_POST['chunk'].".tmp",file_get_contents($_FILES['userfile']['tmp_name']), FILE_APPEND);
      }
      elseif(!empty($datajson->finish)){
        $control = new Controller();
        $control->ConstructMovie($datajson);
      }
      elseif(!empty($datajson->id)){
        $control = new Controller();
        $control->SelectVideoID($datajson->id);
      }
      elseif(!empty($datajson->top_rated)){
        $control = new Controller();
        $control->SelectVideoAlltop_rated();
      }
      break;
    default:
      // Requête invalide
      header("HTTP/1.0 405 Method Not Allowed");
      break;
  }





?>