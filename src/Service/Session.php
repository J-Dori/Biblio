<?php
namespace App\Service;

class Session
{
    public static function setUser($user)
    {
        $_SESSION["user"] = $user;
    }

    public static function getUser()
    {
        if(isset($_SESSION["user"])){
            return $_SESSION["user"];
        }
        else return null;
    }

    public static function removeUser()
    {
        unset($_SESSION["user"]);
    }

    public static function isRoleUser($role)
    {
        if(!self::getUser()){
            return false;
        }
        elseif(self::getUser()->getRole() !== $role){
            return false;
        }
        return true;
    }

    public static function isAnonymous()
    {
        if(self::getUser()){
            return false;
        }
        return true;
    }

    public static function setMessage(string $type, string $text) :void
    {
        unset($_SESSION["messages"]);
        $_SESSION['messages'] = ["type" => $type, "msg" => $text];
    }
}