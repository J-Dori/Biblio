<?php
namespace App\Controller;

use App\Service\AbstractController;
use App\Controller\LivreController;

class HomeController extends AbstractController
{
    public function __construct()
    {
        $this->livre = new LivreController;
    }
    
    public function index(): array
    {
        return $this->livre->index(); 
    }

}