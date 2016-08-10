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
}
