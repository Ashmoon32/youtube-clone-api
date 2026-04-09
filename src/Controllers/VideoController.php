<?php
namespace App\Controllers;

use App\Config\Database;
use PDO;

class VideoController
{
    private ?PDO $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function getAllVideos()
    {
        $stmt = $this->db->prepare("SELECT * FROM videos");
        $stmt->execute();
        $videos = $stmt->fetchAll();

        return [
            "status" => "success",
            "data" => $videos
        ];
    }
}


?>