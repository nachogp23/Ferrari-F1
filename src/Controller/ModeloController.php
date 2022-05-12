<?php

namespace App\Controller;

use App\Entity\Modelo;
use App\Entity\Piloto;
use App\Form\ModeloType;
//use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class ModeloController extends AbstractController
{

    #[Route("")]
    #[Route("/modelos", name: "listaModelos")]
    public function showModelos(EntityManagerInterface $doctrine)
    {
        $repositorio = $doctrine->getRepository(Modelo::class);
        $modelos = $repositorio->findAll();

        return $this->render(
            "modelos/listModelos.html.twig",
            ["modelos" => $modelos]);
    }
    

    #[Route("/modelo/{id}", name: "modeloDetalle")]
    #[IsGranted("ROLE_USER")]
    public function showModelo($id, EntityManagerInterface $doctrine)

    {
        $repositorio = $doctrine->getRepository(Modelo::class);
        $modelo = $repositorio->find($id);

        return $this->render(
            "modelos/modelo.html.twig",
            ["modelo" => $modelo]);
    }

    #[Route("/insert/modelo", name: "insertModelo")]
    #[IsGranted("ROLE_USER")]
    public function insertModelo(Request $request, EntityManagerInterface $doctrine)
    {
        $form = $this->createForm(ModeloType::class);
        $form-> handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $modelo = $form->getData();
            
            $doctrine->persist($modelo);
            $doctrine->flush();
            $this->addFlash(
                "succes", "Modelo insertado correctamente"
            );
           return $this->redirectToRoute("listaModelos");
        }
        return $this->renderForm("modelos/insertModelos.html.twig", ["modeloForm"=>$form]);
    }

    #[Route("/update/modelo/{id}", name: "updateModelo")]
    #[IsGranted("ROLE_USER")]
    public function updateModelo($id, Request $request, EntityManagerInterface $doctrine)
    {
        $repositorio = $doctrine->getRepository(Modelo::class);
        $modelo = $repositorio->find($id);
        
        $form = $this->createForm(ModeloType::class, $modelo);
        $form-> handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $modelo = $form->getData();
            
            $doctrine->persist($modelo);
            $doctrine->flush();
            $this->addFlash(
                "succes", "Modelo insertado correctamente"
            );
           return $this->redirectToRoute("listaModelos");
        }
        return $this->renderForm("modelos/insertModelos.html.twig", ["modeloForm"=>$form]);
    }

    #[Route("/remove/modelo/{id}", name: "eliminarModelo")]
    #[IsGranted("ROLE_USER")]
    public function deleteModelo($id, EntityManagerInterface $doctrine)

    {
        $repositorio = $doctrine->getRepository(Modelo::class);
        $modelo = $repositorio->find($id);
        $doctrine->remove($modelo);
        $doctrine->flush();
        return $this->redirectToRoute("listaModelos");

    }

    #[Route("/poblate")]
    public function insertModelos(EntityManagerInterface $doctrine) 
    {
        //Poblate DB with drivers
        $piloto1 = new Piloto();
        $piloto1->setNombre("Alberto Ascari");
        $piloto1->setTitulos(2);
        $piloto1->setImagen("https://upload.wikimedia.org/wikipedia/commons/thumb/6/69/Ascari_last_photo_in_car.jpg/368px-Ascari_last_photo_in_car.jpg");

        $piloto2 = new Piloto();
        $piloto2->setNombre("Giuseppe Farina");
        $piloto2->setTitulos(1);
        $piloto2->setImagen("https://upload.wikimedia.org/wikipedia/commons/f/fc/NinoFarina.jpg");


        $piloto3 = new Piloto();
        $piloto3->setNombre("Michael Schumacher");
        $piloto3->setTitulos(7);
        $piloto3->setImagen("https://upload.wikimedia.org/wikipedia/commons/thumb/c/c6/Michael_Schumacher_2005_United_States_GP_%2819872855%29_%28cropped%29.jpg/338px-Michael_Schumacher_2005_United_States_GP_%2819872855%29_%28cropped%29.jpg");


        $piloto4 = new Piloto();
        $piloto4->setNombre("Fernando Alonso");
        $piloto4->setTitulos(2);
        $piloto4->setImagen("https://upload.wikimedia.org/wikipedia/commons/thumb/b/bc/Alonso_2020_in_Renault_kit.jpg/338px-Alonso_2020_in_Renault_kit.jpg");

        $piloto5 = new Piloto();
        $piloto5->setNombre("Niki Lauda");
        $piloto5->setTitulos(3);
        $piloto5->setImagen("https://upload.wikimedia.org/wikipedia/commons/thumb/5/53/%C3%96AMTC_Welt_des_Motorsports_2016-4_%28cropped%29.jpg/368px-%C3%96AMTC_Welt_des_Motorsports_2016-4_%28cropped%29.jpg");

        $piloto6 = new Piloto();
        $piloto6->setNombre("Alain Prost");
        $piloto6->setTitulos(4);
        $piloto6->setImagen("https://upload.wikimedia.org/wikipedia/commons/thumb/b/b1/Festival_automobile_international_2015_-_Photocall_-_065.jpg/800px-Festival_automobile_international_2015_-_Photocall_-_065.jpg");

        $piloto7 = new Piloto();
        $piloto7->setNombre("Kimi Räikkönen");
        $piloto7->setTitulos(1);
        $piloto7->setImagen("https://upload.wikimedia.org/wikipedia/commons/9/96/F12019_Schloss_Gabelhofen_%2822%29.jpg");


        //Poblate DB with cars
        $modelo1 = new Modelo();
        $modelo1->setNombre("Ferrari 125");
        $modelo1->setTemporada(1950);
        $modelo1->setCilindrada(1500);
        $modelo1->setTurbo(false);
        $modelo1->setPeso(710);
        $modelo1->setImagen("https://upload.wikimedia.org/wikipedia/commons/thumb/a/a8/Ferrari_125_166_%2834880052384%29.jpg/1200px-Ferrari_125_166_%2834880052384%29.jpg");
        $modelo1->addPiloto($piloto1);
        $modelo1->addPiloto($piloto2);

        $modelo2 = new Modelo();
        $modelo2->setNombre("Ferrari 375");
        $modelo2->setTemporada(1950);
        $modelo2->setCilindrada(4000);
        $modelo2->setTurbo(false);
        $modelo2->setPeso(560);
        $modelo2->setImagen("https://upload.wikimedia.org/wikipedia/commons/thumb/8/8d/Galleria_Ferrari_%2812%29_%283955971732%29.jpg/1280px-Galleria_Ferrari_%2812%29_%283955971732%29.jpg");
        $modelo2->addPiloto($piloto1);
        $modelo2->addPiloto($piloto2);


        $modelo3 = new Modelo();
        $modelo3->setNombre("Ferrari 500");
        $modelo3->setTemporada(1952);
        $modelo3->setCilindrada(1894);
        $modelo3->setTurbo(false);
        $modelo3->setPeso(560);
        $modelo3->setImagen("https://upload.wikimedia.org/wikipedia/commons/thumb/b/b1/Ferrari_500_F2_front-left_Donington_Grand_Prix_Collection.jpg/330px-Ferrari_500_F2_front-left_Donington_Grand_Prix_Collection.jpg");
        $modelo3->addPiloto($piloto1);
        $modelo3->addPiloto($piloto2);

        $modelo4 = new Modelo();
        $modelo4->setNombre("Ferrari F1-2000");
        $modelo4->setTemporada(2000);
        $modelo4->setCilindrada(3000);
        $modelo4->setTurbo(false);
        $modelo4->setPeso(600);
        $modelo4->setImagen("https://upload.wikimedia.org/wikipedia/commons/9/97/Rubens_Barrichello_2000_Belgian.jpg");
        $modelo4->addPiloto($piloto3);

        $modelo5 = new Modelo();
        $modelo5->setNombre("Ferrari F10");
        $modelo5->setTemporada(2010);
        $modelo5->setCilindrada(2400);
        $modelo5->setTurbo(true);
        $modelo5->setPeso(900);
        $modelo5->setImagen("https://upload.wikimedia.org/wikipedia/commons/thumb/3/37/Felipe_Massa_Ferrari_during_Bahrain_2010_GP.jpg/1920px-Felipe_Massa_Ferrari_during_Bahrain_2010_GP.jpg");
        $modelo5->addPiloto($piloto4);

        $modelo6 = new Modelo();
        $modelo6->setNombre("Ferrari 312T");
        $modelo6->setTemporada(1975);
        $modelo6->setCilindrada(2992);
        $modelo6->setTurbo(false);
        $modelo6->setPeso(650);
        $modelo6->setImagen("https://upload.wikimedia.org/wikipedia/commons/d/d4/LaudaNiki19760731Ferrari312T2.jpg");
        $modelo6->addPiloto($piloto5);

        $modelo7 = new Modelo();
        $modelo7->setNombre("Ferrari 641");
        $modelo7->setTemporada(1991);
        $modelo7->setCilindrada(3500);
        $modelo7->setTurbo(false);
        $modelo7->setPeso(765);
        $modelo7->setImagen("https://upload.wikimedia.org/wikipedia/commons/thumb/c/ce/Ferrari_641-2_front-left2_Museo_Ferrari.jpg/413px-Ferrari_641-2_front-left2_Museo_Ferrari.jpg");
        $modelo7->addPiloto($piloto6);

        $modelo8 = new Modelo();
        $modelo8->setNombre("Ferrari F2007");
        $modelo8->setTemporada(2007);
        $modelo8->setCilindrada(2400);
        $modelo8->setTurbo(false);
        $modelo8->setPeso(890);
        $modelo8->setImagen("https://upload.wikimedia.org/wikipedia/commons/thumb/c/cb/Kimi_Raikkonen_2007_Belgium.jpg/1280px-Kimi_Raikkonen_2007_Belgium.jpg");
        $modelo8->addPiloto($piloto7);

//Persist de todos los elementos creados como istancias de las entidades de BD, para que symfony sepa que seran para la BD cuando se haga flush
        $doctrine->persist($piloto1);
        $doctrine->persist($piloto2);
        $doctrine->persist($piloto3);
        $doctrine->persist($piloto4);
        $doctrine->persist($piloto5);
        $doctrine->persist($piloto6);
        $doctrine->persist($piloto7);


        $doctrine->persist($modelo1);
        $doctrine->persist($modelo2);
        $doctrine->persist($modelo3);
        $doctrine->persist($modelo4);
        $doctrine->persist($modelo5);
        $doctrine->persist($modelo6);
        $doctrine->persist($modelo7);
        $doctrine->persist($modelo8);

// flush para añador a BD lo que se haya persistido

        $doctrine->flush();

        //return new Response ("Pilotos y coches añadidos a la BD");
        
        return $this->redirectToRoute("listaModelos");
    }

}