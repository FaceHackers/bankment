<?php
class Session
{

    public function sessionErrorAction($info)
    {
        if ($info == "error") {
            $_SESSION['alert'] = "餘額不足";
        }
    }
}
