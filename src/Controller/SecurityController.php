<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Service\Session;
use App\Model\Manager\UserManager;
use App\Controller\UserController;


class SecurityController extends AbstractController
{

    public function __construct()
    {
        $this->userManager = new UserManager();
        $this->userController = new UserController;
        $this->session = new Session();
    }
 
    public function index(): array
    {
        return $this->render("security/login.php");
    }

//***************************** USERS ACTIONS ****************************/
    public function changePassword() {
        $user = Session::getUser();
        if(!empty($_POST)){
            $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/"
                ]
            ]);
            $password_new = filter_input(INPUT_POST, "password_new", FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/"
                ]
            ]);
            $password_repeat = filter_input(INPUT_POST, "password_repeat", FILTER_DEFAULT);
            
            if($password && $password_new && $password_repeat){
                $email = Session::getUser()->getEmail();

                if($email && $password) {
                    $user = Session::getUser();

                    if($user) {
                        $oldPassword = $this->userManager->findPasswordByEmail($email);
                        if (password_verify($password, $oldPassword )) {
                            if ($password_new !== $password_repeat) {
                                $this->addFlash("error", "The fields <b>New password</b> and <b>Repeat new password</b><br>must be the same. Please try again!...");
                                return $this->render("user/formChangePassword.php");
                            }
                            else {
                                //upd password
                                $hash = password_hash($password_new, PASSWORD_ARGON2I);
                                $this->userManager->updatePassword($email, $hash);
                                $this->addFlash("success", "Password changed succesfully!<br>Please Login again...");
                                $this->logoutUser();
                                return $this->render("security/login.php");
                            }

                        } else
                            $this->addFlash("error", "Your <b>Actual password</b> is not correct.<br>Please try again!");
                            return $this->render("user/formChangePassword.php");
                    }
                }
            } else
                $this->addFlash("error", "All fields are required");
                return $this->render("user/formChangePassword.php");
        }
    }


    public function modifyData() {
        if(!empty($_POST)){
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_STRING);
            $dn = filter_input(INPUT_POST, "dn", FILTER_SANITIZE_STRING);
            $adresse = filter_input(INPUT_POST, "adresse", FILTER_SANITIZE_STRING);
            $cp = filter_input(INPUT_POST, "cp", FILTER_SANITIZE_STRING);
            $city = filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL); 

            if($nom && $prenom && $dn && $adresse && $cp && $city && $email)
            {
                if ($email != Session::getUser()->getEmail()) 
                {
                    if(!$this->userManager->verifyUser($email))
                    {
                        $this->userManager->modifyData(Session::getUser()->getId(), $nom, $prenom, $dn, $adresse, $cp, $city, $email);
                        $this->logoutUser();
                        $this->addFlash("success", "Vos données personnelles ont été modifiées avec succès mais vous avez saisi une nouvelle adresse e-mail.<br><br>Veuillez vous reconnecter !");
                        return $this->render("security/login.php"); 
                    }
                    else { 
                        $this->addFlash("error", "This E-mail is already in use!<br>Please choose another...");
                        return $this->render("user/formModifyData.php"); 
                    }
                }
                else {
                    $this->userManager->modifyData(Session::getUser()->getId(), $nom, $prenom, $dn, $adresse, $cp, $city, $email);
                    $user = $this->userManager->findUserByEmail($email);
                    Session::setUser($user);
                }
            }
            else $this->addFlash("error", "All fields are required");
        }
        return $this->userController->profile();
    }


    public function deleteAccountConfirmation() {
        if (isset($_GET["emp"])) {
            if ((int)$_GET["emp"] == 0) {
                $this->addFlash("delete", "Vous souhaitez supprimer votre compte Membre.<br>Cette action est permanente!<br><br>Êtes-vous sûr?");
                return $this->userController->profile();
            }
            else {
                $this->addFlash("error", "Désolé...<br>Vous ne pouvez pas supprimer<br>votre compte pour le moment.<br><br>Vous avez <b>". $_GET["emp"] ." livres</b> à rendre");
                return $this->userController->profile();
            }
        }
    }

    public function deleteMember($id) 
    {        
        $name = Session::getUser()->getPrenom();
        $this->logoutUser();
        $this->userManager->deleteMember($id);
        $this->addFlash("success", "Nous sommes profondément désolés d'apprendre que vous avez supprimé votre compte !<br>Nous espérons que vous nous rejoindrez bientôt.<br><br>Au revoir <b>$name</b>");
        return $this->redirectTo('index.php');            
    }

//***************************** LOGIN / REGISTER / LOGOUT ****************************/
    public function login(): array
    {
        if(!empty($_POST)){
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/"
                    //min - 6 carac
                ]
            ]);

            if($email && $password){
                $user = $this->userManager->findUserByEmail($email);

                if($user) {
                    if (password_verify ($password, 
                            $this->userManager->findPasswordByEmail($email)
                        ))
                    {
                        Session::setUser($user);
                        $this->addFlash("success", "Welcome back <b>". $user->getPrenom()."</b> !");
                        $this->redirectTo("index.php");
                    }
                }
                else $this->addFlash("error", "Your E-mail or Password are incorrect");
            }
            else $this->addFlash("error", "All fields are required");
        }

        return $this->render("security/login.php"); 
    }



    public function register()
    {
        if(!empty($_POST)){
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_STRING);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_STRING);
            $dn = filter_input(INPUT_POST, "dn", FILTER_SANITIZE_STRING);
            $adresse = filter_input(INPUT_POST, "adresse", FILTER_SANITIZE_STRING);
            $cp = filter_input(INPUT_POST, "cp", FILTER_SANITIZE_STRING);
            $city = filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_VALIDATE_REGEXP, [
                "options" => [
                    "regexp" => "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/"
                ]
            ]);
            $password_r = filter_input(INPUT_POST, "password_repeat", FILTER_DEFAULT);

            if($nom && $prenom && $dn && $adresse && $cp && $city && $email && $password && $password_r){
                
                if($password === $password_r){
                   
                    if(!$this->userManager->verifyUser($email)){
                        $hash = password_hash($password, PASSWORD_ARGON2I);
                        
                        if($this->userManager->insertUser($nom, $prenom, $dn, $adresse, $cp, $city, $email, $hash)){
                            $user = $this->userManager->findUserByEmail($email);
                            Session::setUser($user);
                            $this->addFlash("success", "Welcome to our Forum!");
                            return $this->userController->profile();
                        }
                        else $this->addFlash("error", "Error 500, please try again later !");
                    }
                    else $this->addFlash("error", "This E-mail is already in use!<br>Please choose another...");
                }
                else $this->addFlash("error", "Passwords do not match !");
            }
            else $this->addFlash("error", "All fields are required");
        }
        return $this->render("security/register.php"); 
    }

    public function logout()
    {
        $name = Session::getUser()->getPrenom();
        $this->logoutUser();
        $this->addFlash("success", "You've been logged out!<br>See you soon <b>$name</b>...");
        $this->redirectTo('index.php');
    }

}