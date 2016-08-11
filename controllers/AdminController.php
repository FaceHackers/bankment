<?php

class AdminController extends Controller
{
    //顯示所有戶頭帳號
    function index()
    {
        $admin = $this->model("Account");
        $data  = $admin->readAccount();
        $this->view("admin", $data);
    }

    //查看戶頭餘額
    function readBalance()
    {
        $show_id = $_GET['show_id'];
        $admin   = $this->model("Account");
        $data    = $admin->getAccount($show_id);
        $this->view("readbalance", $data);
    }

    //顯示戶頭存款畫面
    function readePosit()
    {
        $show_id = $_GET['show_id'];
        $admin   = $this->model("Account");
        $data    = $admin->getAccount($show_id);
        $this->view("addeposit", $data);
    }

    //戶頭存款
    function addePosit()
    {
        $eposit        = $_POST['eposit'];
        $account       = $_POST['account'];
        $date          = date ("Y-m-d H:i:s");

        $admin         = $this->model("Account");
        $account_id    = $admin->getAccount($account);
        $pay           = $this->model("Pay");
        $updatebalance = $admin->updateEposit($account, $eposit);

        $addpay        = $pay->eposit($account, $eposit, $date);
        $this->index();
    }

    //顯示戶頭提款畫面
    function readIspensing()
    {
        $show_id = $_GET['show_id'];
        $admin   = $this->model("Account");

        $data    = $admin->getAccount($show_id);
        $this->view("deldispensing", $data);
    }

    //戶頭提款
    function deldIspensing()
    {
        $dispensing  = $_POST['dispensing'];
        $account     = $_POST['account'];
        $date        = date ("Y-m-d H:i:s");

        $admin       = $this->model("Account");
        $pay         = $this->model("Pay");

        $result = $admin->updatedIspensing($account, $dispensing);
        $account_id = $admin->getAccount($account);

        if ($result != 0) {
            $addpay = $pay->dispensingPay($account, $dispensing, $date);
            $this->index();
        } else {
    	    $error  = $this->model("Session");
            $errorr = $error->sessionErrorAction("error");
    		header("location: readispensing?show_id=$account");
    		exit;
    	}
    }

    //顯示戶頭明細
    function readPay()
    {
        $show_id = $_GET['show_id'];
        $admin   = $this->model("Pay");
        $data    = $admin->readPay($show_id);
        $this->view("readpay", $data);
    }
}
