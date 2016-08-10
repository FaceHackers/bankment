<?php

class AdminController extends Controller
{
    //顯示所有戶頭帳號
    function index()
    {
        $admin = $this->model("Account");
        $data  = $admin->readaccount();
        $this->view("admin", $data);
    }
    //查看戶頭餘額
    function readbalance()
    {
        $show_id = $_GET['show_id'];
        $admin   = $this->model("Account");
        $data    = $admin->readbalance($show_id);
        $this->view("readbalance", $data);
    }
    //顯示戶頭存款畫面
    function readeposit()
    {
        $show_id = $_GET['show_id'];
        $admin   = $this->model("Account");
        $data    = $admin->readaccountid($show_id);
        $this->view("addeposit", $data);
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
    //顯示戶頭提款畫面
    function readispensing()
    {
        $show_id = $_GET['show_id'];
        $admin   = $this->model("Account");

        $data    = $admin->readaccountid($show_id);
        $this->view("deldispensing", $data);
    }
        //戶頭提款
    function deldispensing()
    {
        $dispensing  = $_POST['dispensing'];
        $account     = $_POST['account'];
        $date        = date ("Y-m-d H:i:s");

        $admin       = $this->model("Account");
        $pay         = $this->model("Pay");
        $error       = $this->model("Session");
        $account_id  = $admin->account($account);

        $newbalance  = $account_id["balance"] - $dispensing;
        if ($newbalance >= $dispensing) {
            $updatebalance = $admin->updatebalance($account, $newbalance);
            $addpay        = $pay->dispensingpay($account, $dispensing, $date);
            $this->index();
        }
    	else {
            $errorr = $error->sessionErrorAction("error");
    		header("location: readispensing?show_id=$account");
    		exit;
    	}
    }
    //顯示戶頭明細
    function readpay()
    {
        $show_id = $_GET['show_id'];
        $admin   = $this->model("Pay");
        $data    = $admin->readpay($show_id);
        $this->view("readpay", $data);
    }
}
