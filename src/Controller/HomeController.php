<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * LA PAGE D ACCEUIL, affichage des nouveaux produits de moins 1mois
     * @Route("/", name="home")
     * @param ProductRepository $repository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(ProductRepository $repository)
    {
        // findBy() va effectuer une comparaison d'égalité, alors que nous souhaitons effectuer une comparaison de supériorité 
        //  solution: créer notre propre méthode dans le ProductRepository 

        // on a utilise une methode personnaliser dans le fichiers ProductRepository,FindNews
        $result = $repository->findNews();
        return $this->render('home/index.html.twig',[
            'new_products'=>$result
        ]);
    }
}
