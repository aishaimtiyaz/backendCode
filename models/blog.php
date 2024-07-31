<?php
class Blog {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllPosts() {
        $stmt = $this->pdo->query('SELECT * FROM posts');
        return $stmt->fetchAll();
    }

    public function getPost($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM posts WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function createPost($title, $content, $author) {
        $stmt = $this->pdo->prepare('INSERT INTO posts (title, content, author) VALUES (?, ?, ?)');
        return $stmt->execute([$title, $content, $author]);
    }

    public function updatePost($id, $title, $content, $author) {
        $stmt = $this->pdo->prepare('UPDATE posts SET title = ?, content = ?, author = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?');
        return $stmt->execute([$title, $content, $author, $id]);
    }

    public function deletePost($id) {
        $stmt = $this->pdo->prepare('DELETE FROM posts WHERE id = ?');
        return $stmt->execute([$id]);
    }
}
?>
