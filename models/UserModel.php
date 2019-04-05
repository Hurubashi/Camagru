<?php

class UserModel extends Model
{
    public function get_data() {
        return array(

            array(
                'Year' => '2012',
                'Site' => 'http://DunkelBeer.ru',
                'Description' => 'Промо-сайт темного пива Dunkel от немецкого производителя Löwenbraü выпускаемого в России пивоваренной компанией "CАН ИнБев".'
            ),
            array(
                'Year' => '2012',
                'Site' => 'http://ZopoMobile.ru',
                'Description' => 'Русскоязычный каталог китайских телефонов компании Zopo на базе Android OS и аксессуаров к ним.'
            ),
            // todo
        );
    }

    public function checkEnteredData($username, $password) {
        echo "Checking data $username , $password";
    }

    public function createUser($username, $email, $password, $rePassword) {
        echo "Checking data: $username , $email, $password, $rePassword";

        $password = md5($password);
        $pdo = connect_db();
        $sql = "INSERT INTO 'user' (username, password, email) VALUES (?,?,?)";
        $stmt= $pdo->prepare($sql);
        $stmt->execute([$username, $password, $email]);
    }

}

//<?php
//class Contact
//{
//    private $UploadedFiles = '';
//    private $DbHost = DB_HOST;
//    private $DbName = DB_NAME;
//    private $DbUser = DB_USER;
//    private $DbPass = DB_PASS;
//    private $table;
//
//    function __construct()
//    {
//        $this->table = strtolower(get_class());
//    }
//
//    public function insert($values = array())
//    {
//        $dbh = new PDO("mysql:host=$this->DbHost;dbname=$this->DbName", $this->DbUser, $this->DbPass, array(PDO::ATTR_PERSISTENT => true));
//        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        $dbh->exec("SET CHARACTER SET utf8");
//
//        foreach ($values as $field => $v)
//            $ins[] = ':' . $field;
//
//        $ins = implode(',', $ins);
//        $fields = implode(',', array_keys($values));
//        $sql = "INSERT INTO $this->table ($fields) VALUES ($ins)";
//
//        $sth = $dbh->prepare($sql);
//        foreach ($values as $f => $v)
//        {
//            $sth->bindValue(':' . $f, $v);
//        }
//        $sth->execute();
//        //return $this->lastId = $dbh->lastInsertId();
//    }
//
//}
//
//$contact = new Contact();
//$values = array('col1'=>'value1','col2'=>'value2');
//$contact->insert($values);