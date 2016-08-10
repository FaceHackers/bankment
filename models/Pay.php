<?php

class Pay
{
    public $con;
    public $pdoo;

    public function __construct()
    {
        $this->pdoo = new myPDO();
        $this->con  = $this->pdoo ->getConnection();
    }
    //新增存款明細
    function eposit($account, $eposit, $date)
    {
        $sql  = "INSERT INTO `pay` (`account`,`dispensing`,`deposit`,`date`) VALUES (:account, :dispensing, :eposit, :date)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':account', $account);
        $stmt->bindValue(':dispensing','0');
    	$stmt->bindValue(':eposit', $eposit);
    	$stmt->bindValue(':date', $date);
        $data = $stmt->execute();
        $this->pdoo->closeConnection();

        return $data;
    }
    //新增提款明細
    function dispensingpay($account, $dispensing, $date)
    {
        $sql  = "INSERT INTO `pay` (`account`,`dispensing`,`deposit`,`date`) VALUES (:account, :dispensing, :eposit, :date)";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':account', $account);
        $stmt->bindValue(':dispensing', $dispensing);
    	$stmt->bindValue(':eposit','0');
    	$stmt->bindValue(':date', $date);
        $data = $stmt->execute();
        $this->pdoo->closeConnection();

        return $data;
    }
    //顯示戶頭明細
    function readpay($show_id)
    {
        $sql  = "SELECT * FROM `pay` WHERE account = :account Order by `date`";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(':account', $show_id);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->pdoo->closeConnection;

        return $data;
    }
}
