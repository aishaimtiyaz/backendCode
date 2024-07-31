<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once '../../config/db.php';
require_once '../../models/Blog.php';

$blog = new Blog($pdo);

header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            echo json_encode($blog->getPost($id));
        } else {
            echo json_encode($blog->getAllPosts());
        }
        break;
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($blog->createPost($data['title'], $data['content'], $data['author']));
        break;
    case 'PUT':
        $id = intval($_GET['id']);
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($blog->updatePost($id, $data['title'], $data['content'], $data['author']));
        break;
    case 'DELETE':
        $id = intval($_GET['id']);
        echo json_encode($blog->deletePost($id));
        break;
    default:
        echo json_encode(['error' => 'Method not supported']);
        break;
}
?>
