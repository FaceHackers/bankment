<?php

class Pay
{
    public $con;
    public $pdo;

    public function __construct()
    {
        $this->pdo = new MyPDO();
        $this->con  = $this->pdo->getConnection();
    }

    //新增存款明細
    function eposit($account, $eposit, $date)
    {
        $sql  = "SELECT * FROM `account` WHERE account = :account";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':account', $account);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $balance = $data['balance'];
        $newbalance = $balance + $eposit;

        $sql  = "INSERT INTO `pay` (`account`,`dispensing`,`deposit`,`balance`,`date`) VALUES (:account, :dispensing, :eposit, :balance, :date)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':account', $account);
        $stmt->bindValue(':dispensing','0');
    	$stmt->bindValue(':eposit', $eposit);
    	$stmt->bindValue(':balance', $newbalance);
    	$stmt->bindValue(':date', $date);
        $data = $stmt->execute();
        $this->pdo->closeConnection();

        return $data;
    }

    //新增提款明細
    function dispensingPay($account, $dispensing, $date)
    {
        $sql  = "INSERT INTO `pay` (`account`,`dispensing`,`deposit`,`date`) VALUES (:account, :dispensing, :eposit, :date)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':account', $account);
        $stmt->bindValue(':dispensing', $dispensing);
    	$stmt->bindValue(':eposit','0');
    	$stmt->bindValue(':date', $date);
        $data = $stmt->execute();
        $this->pdo->closeConnection();

        return $data;
    }

    //顯示戶頭明細
    function readPay($show_id)
    {
        $sql  = "SELECT * FROM `pay` WHERE account = :account Order by `date`";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':account', $show_id);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->pdo->closeConnection;

        return $data;
    }
}
