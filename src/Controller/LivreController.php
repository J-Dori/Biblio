<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Model\Manager\LivreManager;
use App\Model\Manager\EmpruntManager;

class LivreController extends AbstractController
{
    public function __construct()
    {
        $this->livre = new LivreManager();
        $this->emprunt = new EmpruntManager();
    }
    
    public function index(): array
    {
        return $this->render("livre/livre.php",
            [
                "list" => $this->livre->livresAndExemplaireAvailable(),
                "available" => $this->livre->countAvailability()
            ]
        ); 
    }

    public function livreDetails($id): array
    {
        return $this->render("livre/livreDetails.php",
            [
                "livre" => $this->livre->findOneById($id),
                "emprunt" => $this->emprunt->getActualEmpruntByLivre($id)
            ]
        ); 
    }

    public function emprunterLivreDelai($id): array
    {
        //verify if User already has this book
        $verify = $this->emprunt->verifyEmprunterLivre($id); 
        if ( $verify != null ) {
            $this->addFlash("info", "Vous avez déjà ce livre avec vous depuis le <b>". $verify["date"] ."</b> pour une durée de <b>". $verify["delai"] ."</b> jours.");
        } else
            $this->addFlash("delai", "Pour combien de jours souhaitez-vous emprunter ce livre?");
        
        return $this->index();        
    }

    public function emprunterLivre($id): array
    {
        if(!empty($_POST)){
            $delai = filter_input(INPUT_POST, "delai", FILTER_SANITIZE_NUMBER_INT);
            if ($delai < 1 || $delai > 15 || $delai == null) {
                $this->addFlash("error", "Le delai pour emprunter un liver doit être<br>entre 1 et 15 jours.");
            }
            else
                $this->emprunt->emprunterLivre($id, $delai);
        }
        
        return $this->index();
    }

    


}