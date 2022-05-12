<?php

namespace App\Controller;

use App\Entity\Modelo;
use App\Entity\Piloto;
use App\Form\ModeloType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class PilotoController extends AbstractController
{
   
    //Ruta para mostrar listado de pilotos
    #[Route("/pilotos", name: "listaPilotos")]
    public function showPilotos(EntityManagerInterface $doctrine)
    {
        $repositorio = $doctrine->getRepository(Piloto::class);
        $pilotos = $repositorio->findAll();

        return $this->render(
            "pilotos/listPilotos.html.twig",
            ["pilotos" => $pilotos]);
    }
    
    //Ruta para mostrar un único piloto

    #[Route("/piloto/{id}", name: "pilotoDetalle")]
    #[IsGranted("ROLE_USER")]
    public function showPiloto($id, EntityManagerInterface $doctrine)

    {
        $repositorio = $doctrine->getRepository(Piloto::class);
        $piloto = $repositorio->find($id);

        return $this->render(
            "pilotos/piloto.html.twig",
            ["piloto" => $piloto]);
    }

   
}