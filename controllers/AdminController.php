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
}
