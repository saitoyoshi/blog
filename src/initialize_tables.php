<?php

// require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/libs/utils.php';
// $mysqli = mysqli_connect("db", "test_user", "pass", "test_database");
// var_dump($mysqli);
// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();
// $pdo = new PDO($_ENV['DSN'], $_ENV['USER'], $_ENV['PASSWORD']);
db('drop table if exists post_tags;');
db('drop table if exists posts;');
db('drop table if exists tags;');
db('drop table if exists users;');
$createUsersTableSql = <<< EOT
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    username varchar(255) NOT NULL,
    password varchar(255) NOT NULL,
    email varchar(255) unique NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime NOT NULL
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4
EOT;
db($createUsersTableSql);


// CREATE TABLE db_name.tbl_name
//   (col_name data_type, ...,
//    FOREIGN KEY [index_name] (col_name, ...)
//    REFERENCES tbl_name (col_name, ...))

$createPostsTableSql = <<< EOT
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    user_id int NOT NULL,
    title varchar(255) NOT NULL,
    content text NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4
EOT;
db($createPostsTableSql);


$createTagsTableSql = <<< EOT
CREATE TABLE tags (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    name varchar(255) unique not null
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4
EOT;
db($createTagsTableSql);
$createPostTagsTableSql = <<< EOT
CREATE TABLE post_tags (
    post_id INT NOT NULL,
    tag_id int not null,
    FOREIGN KEY (post_id) REFERENCES posts(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id)
) ENGINE=INNODB DEFAULT CHARSET=utf8mb4
EOT;
db($createPostTagsTableSql);
