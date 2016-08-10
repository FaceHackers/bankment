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
    //查看戶頭餘額
    public function readbalance($show_id)
    {
        $sql  = "SELECT * FROM `account` WHERE account = :account";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':account', $show_id);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->pdoo->closeConnection();

        return $data;
    }
    //顯示戶頭存款畫面
    public function readaccountid($show_id)
    {
        $sql  ="SELECT * FROM `account` WHERE account = :account";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':account', $show_id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->pdoo->closeConnection();

        return $data;
    }
    //查詢戶頭帳號
    public function account($account)
    {
        $sql  = "SELECT * FROM `account` WHERE account = :account";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':account', $account);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->pdoo->closeConnection();

        return $data;
    }
    //更改戶頭餘額
    public function updatebalance($account, $newbalance)
    {
        try {
            $this->con->beginTransaction();

            $sql  = "SELECT `account` FROM `account` WHERE account = :account FOR UPDATE";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':account', $account);
            $stmt->execute();
            $result = $stmt->fetch();

            $sql  = "UPDATE `account` SET `balance`= :balance WHERE `account`= :account";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':balance', $newbalance);
            $stmt->bindValue(':account', $account);
            $result = $stmt->execute();

    	    $this->pdoo->closeConnection();

    	    $this->con->commit();

    	    if($result) {
    	        return true;
	        }else{
	            throw new Exception("你出錯了!");
	        }

        } catch (Exception $error) {
            $this->con->rollBack();
            $error->getMessage();
        }
    }
}
