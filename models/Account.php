<?php

class Account
{
    public $con;

    public $pdoo;

    public function __construct()
    {
        $this->pdoo = new myPDO();
        $this->con  = $this->pdoo->getConnection();
    }
    //讀取戶頭帳號
    public function readaccount()
    {
        $sql  = "SELECT * FROM `account` order by `id`";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->pdoo->closeConnection();

        return $data;
    }
}
