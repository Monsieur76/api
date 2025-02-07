<?php

class Controller
{
    public function SelectVideoControl($nameVideo)
    {
        $class = new Moovie();
        $data = $class->SelectVideo($nameVideo);
        $this->visualise($data);
    }

    public function SelectVideoID($id)
    {
        $class = new Moovie();
        $data = $class->SelectVideo_ID($id);
        $this->visualise($data);
    }

    public function SelectVideoControlBanner()
    {
        $class = new Moovie();
        $data = $class->SelectLastVideo();
        $this->visualise($data);
    }

    public function SelectAlltitle()
    {
        $class = new Moovie();
        $data = $class->SelectAllTitle();
        $this->visualise($data);
    }

    public function SelectVerificationVideo($nameverif)
    {
        $class = new Moovie();
        $data = $class->SelectVideo($nameverif);
        $this->visualise($data);
    }

    public function ConstructMovie($datajson)
    {
        sleep(10);
        $config = parse_ini_file("config.ini", true);
        $finalDir = $config['config_file']['pathfinal'];
        $filePathTmp = $config['config_file']['filePath'];
        $hash = $datajson->title;
        $extension = $datajson->type;
        $extension = explode("/", $extension);
        $extension = $extension[1];
        $scandir = scandir($filePathTmp);
        sort($scandir, SORT_NATURAL);
        unset($scandir[0]);
        unset($scandir[1]);
        $hash = hash('sha256', $hash);
        $hashpath = $hash;
        $hash = $hash.".".$extension;

        $finalFile = fopen($finalDir.$hash, 'w');

        foreach ($scandir as $key => $filePart) {
            $chunk = file_get_contents($filePathTmp.$scandir[$key]);
            fwrite($finalFile, $chunk);
            unlink($filePathTmp.$scandir[$key]);  // Optionally delete the chunk
        }
        
        fclose($finalFile);
        $class = new Moovie();
        $class->RegisterVideo($datajson->title, $hash, $finalDir ,$datajson->poster_path ,$datajson->overview ,$datajson->release_date ,json_encode($datajson->genre_ids) ,$datajson->vote_average ,$datajson->popularity);
    }

    public function SelectVideoAlltop_rated()
    {
        $class = new Moovie();
        $data = $class->SelectVideoAll();
        $this->visualise($data);
    }

    public function visualise($data)
    {
        $data = json_encode($data);
        echo $data;
    }

}