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
}
