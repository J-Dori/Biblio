<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Service\Session;
use App\Model\Manager\UserManager;
use App\Model\Manager\EmpruntManager;

class UserController extends AbstractController
{
    public function __construct()
    {
        $this->session = new Session();
        $this->user = new UserManager();
        $this->emprunt = new EmpruntManager();
    }

    public function index(): array
    {
        return $this->render("home/home.php"); 
    }

    
    public function profile() {
        if (Session::getUser()) {
            return [
                    "view" => "user/profile.php",
                    "data" => [
                        "user" => $this->user->findOneById(Session::getUser()->getId()),
                        "emprunt" => $this->emprunt->empruntByUser(Session::getUser()->getId()),
                    ],
                ];
        } else
            $this->addFlash("error", "Profile not found. Log in, please!");
            return $this->render("security/login.php"); 
    }


    public function formChangePassword() {
        return ["view" => "user/formChangePassword.php"];
    }

    public function formModifyData() {
        return ["view" => "user/formModifyData.php"];
    }


    public function changeAvatarImg() {
        $type = "error";
        $message = "An error has occured.<br>Please try again later!";
        if (!isset($_FILES)) {
            unset($_FILES);
        }
        else {
            $id = Session::getUser()->getId();
            $uploadOk = 1;
            if (isset($_FILES["fileToUpload"])) {
                $tmpname = $_FILES["fileToUpload"]["tmp_name"];
                $name = $_FILES["fileToUpload"]["name"];
                $size = $_FILES["fileToUpload"]["size"];
                $error = $_FILES["fileToUpload"]["error"];
                unset($_FILES);

                $tabExtension = explode(".",$name);
                $extension = strtolower(end($tabExtension));
                $extensionsAllowed = ["jpg", "png", "jpeg", "gif"];
                $maxSize = 2048512;
                
                if(!in_array($extension, $extensionsAllowed)) {
                    $type = "error";
                    $message = "Sorry, only JPG, JPEG, PNG and GIF files are allowed.";
                    $uploadOk = 0;
                }

                if ($size > $maxSize) {
                    $type = "error";
                    $message = "The file size is too big (max: 2Mb)";
                    $uploadOk = 0;
                }

                
                if ($uploadOk == 1 && $error == 0) {
                    $uniqueName = uniqid("", true);
                    $file = str_replace(".", "_", $uniqueName).".".$extension;
                    if (!move_uploaded_file($tmpname, "./public/images/avatar/".$file)) {
                        $type = "error";
                        $message = "Sorry, there was an error uploading your file.";
                        $uploadOk = 0;
                    }
                    $type = "success";
                    $message = "Image uploaded successfully!";
                    
                    $this->userManager->updateAvatarImg($id, $file);
                }
            }
        }
        $this->addFlash($type, $message); 
        return $this->profile();
    }




}