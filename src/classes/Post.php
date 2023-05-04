<?php

class Post {
    private $id;
    private $user_id;
    private $title;
    private $content;
    private $created_at;
    private $updated_at;
    private $username;

    public function __construct($user_id, $title, $content, $id = null, $created_at = null, $updated_at = null) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->title = $title;
        $this->content = $content;
        $this->created_at = $created_at ? $created_at : date('Y-m-d H:i:s');
        $this->updated_at = $updated_at ? $updated_at : date('Y-m-d H:i:s');
    }
    public static function getAllPosts() {
        $sql = "SELECT posts.id, posts.user_id, posts.title, posts.content, posts.created_at, posts.updated_at, users.username FROM posts INNER JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC";
        $result = db($sql);
        $posts = [];
        foreach ($result as $row) {
            $post = new Post(
                $row['user_id'],
                $row['title'],
                $row['content'],
                $row['id'],
                $row['created_at'],
                $row['updated_at']
            );
            $post->setUsername($row['username']);
            $posts[] = $post;
        }
        return $posts;
    }

    public static function getPostById($id) {
        $sql = 'SELECT * FROM posts WHERE id = ?';
        $result = db($sql, $id);
        if ($result) {
            return new Post(
                $result[0]['user_id'],
                $result[0]['title'],
                $result[0]['content'],
                $result[0]['id'],
                $result[0]['created_at'],
                $result[0]['updated_at']
            );
        } else {
            return null;
        }
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }
    // ...（以前のゲッターおよびセッターメソッドはそのままにしておく）
    public function getId() {
        return $this->id;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function getUpdatedAt() {
        return $this->updated_at;
    }

    public function setUpdatedAt($updated_at) {
        $this->updated_at = $updated_at;
    }

    // ここに createPost(), editPost(), deletePost() のようなメソッドを追加できます。
    // ただし、これらのメソッドはデータベースやファイルシステムなどの永続化に関連する処理を含む可能性があるため、
    // このクラスの設計に関連するデータアクセス層（例：データベース操作用のクラス）やサービス層を検討することをお勧めします。
    public function createPost() {
        db('INSERT INTO posts (user_id, title, content, created_at, updated_at) VALUES (?, ?, ?, ?, ?)', $this->getUserId(), $this->getTitle(), $this->getContent(), $this->getCreatedAt(), $this->getUpdatedAt());
    }
}
