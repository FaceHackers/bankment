<?php

class Account
{
    public $con;
    public $pdoo;

    public function __construct()
    {
        $this->pdo = new MyPDO();
        $this->con  = $this->pdo->getConnection();
    }

    //讀取戶頭帳號
    public function readAccount()
    {
        $sql  = "SELECT * FROM `account` order by `id`";
        $stmt = $this->con->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->pdo->closeConnection();

        return $data;
    }

    //查看戶頭餘額
    public function readBalance($show_id)
    {
        $sql  = "SELECT * FROM `account` WHERE account = :account";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':account', $show_id);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->pdo->closeConnection();

        return $data;
    }

    //顯示戶頭存款畫面
    public function readAccountid($show_id)
    {
        $sql  ="SELECT * FROM `account` WHERE account = :account";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':account', $show_id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->pdo->closeConnection();

        return $data;
    }

    //查詢戶頭帳號
    public function getAccount($account)
    {
        $sql  = "SELECT * FROM `account` WHERE account = :account";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':account', $account);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->pdo->closeConnection();

        return $data;
    }

    //更改戶頭餘額提款
    public function updatedIspensing($account, $dispensing)
    {
        $result = 0;
        try {
            $this->con->beginTransaction();

            $sql  = "SELECT * FROM `account` WHERE account = :account FOR UPDATE";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':account', $account);
            $stmt->execute();
            $data = $stmt->fetch();
            sleep(5);
            if ($data['balance'] - $dispensing >= 0) {
                $sql  = "UPDATE `account` SET `balance`= `balance` - :balance
                         WHERE `account`= :account";
                $stmt = $this->con->prepare($sql);
                $stmt->bindValue(':balance', $dispensing, PDO::PARAM_INT);
                $stmt->bindValue(':account', $account);
                $result = $stmt->execute();

                //return $result;
            } else {
                throw new Exception('餘額不足');
                //return false;
            }
    	    $this->pdo->closeConnection();
    	    $this->con->commit();
        } catch (Exception $error) {
            $this->con->rollBack();
            $error->getMessage();
        }
        return $result;
    }

    //更改戶頭餘額存款
    public function updateEposit($account, $eposit)
    {
        try {
            $this->con->beginTransaction();

            $sql  = "SELECT * FROM `account` WHERE account = :account" . "LOCK IN SHARE MODE";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':account', $account);

            $result = $stmt->fetch();
            sleep(5);
            $sql  = "UPDATE `account` SET `balance`= `balance` + :balance
                     WHERE `account`= :account";
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':balance', $eposit, PDO::PARAM_INT);
            $stmt->bindValue(':account', $account);
            $result = $stmt->execute();

    	    $this->pdo->closeConnection();
    	    $this->con->commit();
        } catch (Exception $error) {
            $this->con->rollBack();
            $error->getMessage();
        }
    }
}
