<?php

function connect_db()
{
    require ROOT.'/config/database.php';
    try {
        $pdo =  new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }catch (PDOException $e)
    {
        echo $e->getMessage();
    }
    return false;
}

?>