<?php



function h(string $str): string {
    return htmlspecialchars($str, ENT_QUOTES | ENT_HTML5);
}

function db(): ?array {
    $args = func_get_args();
    if (count($args) > 0) {
        $sql = $args[0];
        try {
            require_once __DIR__ . '/../vendor/autoload.php';
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
            $dotenv->load();
            $pdo = new PDO($_ENV['DSN'], $_ENV['USER'], $_ENV['PASSWORD']);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $prepare = $pdo->prepare($sql);
            // SQL文中に変数を含んでいれば
            $sql2 = $sql;
            if (count($args) > 1) {
                for ($i = 1; $i < count($args); $i++) {
                    $prepare->bindValue($i, $args[$i], PDO::PARAM_STR);
                    $sql2 = preg_replace("/\?/", "'" . $args[$i] . "'", $sql2, 1);
                }
            }
            $prepare->execute();
            $result = $prepare->fetchAll(PDO::FETCH_ASSOC);
            // db_log($sql2);
            $pdo = null;
            return $result;
        } catch (Exception $e) {
            echo 'DB ERROR!!' . $e;
            exit('DB ERROR!!' . $e);
            return null;
        }
    } else {
        // 引数不足
        exit('db()の引数指定がおかしいです');
    }
}
