<?php



function h(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5);
}

function db(string $sql, ...$params): mixed {
    try {
        require_once __DIR__ . '/../vendor/autoload.php';
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
        $pdo = new PDO($_ENV['DSN'], $_ENV['USER'], $_ENV['PASSWORD']);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $prepare = $pdo->prepare($sql);

        // SQL文中に変数を含んでいれば
        foreach ($params as $i => $param) {
            $prepare->bindValue($i + 1, $param, PDO::PARAM_STR);
        }

        $prepare->execute();

        // INSERT文であったら、その文が実行された行のIDを返す
        if (stripos(trim($sql), 'INSERT') === 0) {
            return $pdo->lastInsertId();
        }

        $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
        $pdo = null;
        return $result;
    } catch (Exception $e) {
        echo 'DB ERROR!!' . $e;
        exit('DB ERROR!!' . $e);
        return null;
    }
}

function getTagsByPostId($post_id) {
    $sql = "SELECT t.name FROM tags t
            JOIN post_tags pt ON t.id = pt.tag_id
            WHERE pt.post_id = ?";
    $tagNamesResult = db($sql, $post_id);
    $tagNames = array_column($tagNamesResult, 'name');
    return $tagNames;
}
