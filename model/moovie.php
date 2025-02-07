<?php

class Moovie
{
    private $db;
    public $path_thdm = "https://image.tmdb.org/t/p/original/";
    public $title;
    public $hash;
    public $id;
    public $file_path ;
    public $date;
    public $poster_path;
    public $overview;
    public $release_date;
    public $genre_ids;
    public $vote_average;
    public $popularity;
    
    function __construct()
    {
        $this->db = Database::get();
    }

    public function RegisterVideo($title, $hash, $file_path ,$poster_path ,$overview ,$release_date ,$genre_ids ,$vote_average ,$popularity)
    {
        try {
            $sql = "INSERT INTO film (title, hash, file_path , date ,poster_path ,overview ,release_date ,genre_ids ,vote_average ,popularity)
                    VALUES (?,?,?,NOW(),?,?,?,?,?,?)";
            $data = $this->db->prepare($sql);
            $data->execute(array($title, $hash, $file_path ,$poster_path ,$overview ,$release_date ,$genre_ids ,$vote_average ,$popularity));
            $data->closeCursor();
        } catch (Exception $e) {
            $e->getMessage();
        }
    }

    public function SelectVideo($name)
    {
        $sql = 'SELECT title,id,hash,file_path ,date,poster_path,overview,release_date,genre_ids,vote_average,popularity FROM `film` WHERE title = ?';
        $data = $this->db->prepare($sql);
        $data->execute([$name]);
        $data->setFetchMode(PDO::FETCH_CLASS, 'Moovie');
        return $data->fetch();
    }

    public function SelectLastVideo()
    {
        $sql = 'SELECT title,id,hash,file_path ,date,poster_path,overview,release_date,genre_ids,vote_average,popularity FROM `film` ORDER BY date DESC, id DESC';
        $data = $this->db->prepare($sql);
        $data->execute();
        $data->setFetchMode(PDO::FETCH_CLASS, 'Moovie');
        return $data->fetch();
    }

    public function RegisterFilm($name)
    {
        $sql = 'SELECT title FROM `film`';
        $data = $this->db->prepare($sql);
        $data->execute();
        $data->setFetchMode(PDO::FETCH_CLASS, 'Moovie');
        return $data->fetch();
    }

    public function SelectVideoAll()
    {
        $sql = 'SELECT title,id,hash,file_path ,date,poster_path,overview,release_date,genre_ids,vote_average,popularity FROM `film` ORDER BY vote_average ASC, popularity ASC';
        $data = $this->db->prepare($sql);
        $data->execute();
        $data->setFetchMode(PDO::FETCH_CLASS, 'Moovie');
        return $data->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function SelectVideo_ID($id)
    {
        $sql = 'SELECT title,id,hash,file_path ,date,poster_path,overview,release_date,genre_ids,vote_average,popularity FROM `film` WHERE id = ?';
        $data = $this->db->prepare($sql);
        $data->execute([$id]);
        $data->setFetchMode(PDO::FETCH_CLASS, 'Moovie');
        return $data->fetch();
    }
    
   /* public function deletePostConfirm($id)
    {
        $delete = "DELETE  FROM post WHERE post.id = ?";
        $deleteCom = "DELETE post , commentary FROM post INNER JOIN
                      commentary ON post.id = commentary.id_post WHERE post.id = ?";
        $data = $this->db->prepare($deleteCom);
        $database = $this->db->prepare($delete);
        $data->execute([$id]);
        $database->execute([$id]);
    }

    public function postSelect()
    {
        $sql = "SELECT id,title,chapo,contained,author,DATE_FORMAT(date_post,'%d/%m/%Y %H:%i:%s')
                AS datePost FROM post ORDER BY date_post DESC ";
        $data = $this->db->prepare($sql);
        $data->execute();
        return $data;
    }

    /*
     *
     */
   /* public function postSelectDisplay()
    {
        $sql = "SELECT title,chapo,id,DATE_FORMAT(date_post,'%d/%m/%Y %H:%i:%s')AS datePost
                FROM post ORDER BY date_post DESC ";
        $data = $this->db->prepare($sql);
        $data->execute();
        return $data;
    }

    public function displayPost($id)
    {
        $sql = "SELECT id,contained,title,chapo,author,DATE_FORMAT(date_post,'%d/%m/%Y %H:%i:%s')AS date_post
                FROM post WHERE id = ?";
        $data = $this->db->prepare($sql);
        $data->execute([$id]);
        return $data;
    }

    public function updatePost($post)
    {
        $update = "UPDATE post SET title = ? , chapo = ?, contained = ? , author = ? ,
            date_post = NOW() WHERE id = ?";
        $data = $this->db->prepare($update);
        $data->execute(array($post['title'], $post['chapo'], $post['contained'],
            $post['author'], $post['id']));
    }*/
}