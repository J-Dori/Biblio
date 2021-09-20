<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Model\Manager\EmpruntManager;

class EmpruntController extends AbstractController
{
    public function __construct()
    {
        $this->emprunt = new EmpruntManager();
    }
    
    public function index(): array
    {
        return $this->render("emprunt/emprunt.php",
            [
                "list" => $this->emprunt->getAllEmprunt()
            ]
        ); 
    }


    public function rendreLivre($id): array
    {
        $this->emprunt->rendreLivre($id);
        return $this->index();
    }


}