<?php require('./config.php');?>

<?php

error_reporting(E_ALL);
ini_set('display_error',1);
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Headers:*');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Origin:*');

$object = new crud;
$conn = $object->connect();
$method = $_SERVER['REQUEST_METHOD'];


switch ($method) {

    case 'GET' :

        $path = explode('/' , $_SERVER['REQUEST_URI']);
        $user_id = $path[4];
        $sql = "SELECT * FROM `users` 
                INNER JOIN `posts` ON posts.user_id = users.id
                WHERE id = '$user_id' AND group_id = '0'
                ORDER BY `created_at` DESC" ;
        $query = $conn->prepare($sql);
        $query->execute();
        $posts = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($posts);
        break;

}