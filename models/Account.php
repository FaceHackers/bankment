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
    //戶頭存款
    function addeposit()
    {
        $eposit        = $_POST['eposit'];
        $account       = $_POST['account'];
        $date          = date ("Y-m-d H:i:s");

        $admin         = $this->model("Account");
        $account_id    = $admin->account($account);
        $newbalance    = $account_id["balance"] + $eposit;
        $pay           = $this->model("Pay");
        $updatebalance = $admin->updatebalance($account, $newbalance);
        $addpay        = $pay->eposit($account, $eposit, $date);
        $this->index();
    }
}
