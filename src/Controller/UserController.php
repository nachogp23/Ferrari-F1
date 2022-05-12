<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\UserType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route("/insert/user", name: "insertUser")]
    public function insertUser(Request $request, EntityManagerInterface $doctrine, UserPasswordHasherInterface $hasher)
    {
        $form = $this->createForm(UserType::class);
        $form-> handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $user = $form->getData();
            
            //hashing user password
            $password = $hasher->hashPassword($user, $user->getPassword());
            $user->setPassword($password);

            $doctrine->persist($user);
            $doctrine->flush();
            $this->addFlash(
                "succes", "Modelo insertado correctamente"
            );
        }
        return $this->renderForm("users/insertUsers.html.twig", ["userForm"=>$form]);
    }

    #[Route("/insert/admin/user", name: "insertAdminUser")]
    public function insertAdminUser(Request $request, EntityManagerInterface $doctrine, UserPasswordHasherInterface $hasher)
    {
        $form = $this->createForm(UserType::class);
        $form-> handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
            $user = $form->getData();
            $user->setRoles(['ROLE_ADMIN']);
            //hashing user password
            $password = $hasher->hashPassword($user, $user->getPassword());
            $user->setPassword($password);

            $doctrine->persist($user);
            $doctrine->flush();
            $this->addFlash(
                "succes", "Modelo insertado correctamente"
            );
        }
        return $this->renderForm("users/insertUsers.html.twig", ["userForm"=>$form]);
    }

    #[Route("/user", name: "showUser")]
    public function showUser(Request $request, EntityManagerInterface $doctrine, UserPasswordHasherInterface $hasher)
    {
        
        return $this->renderForm("users/showUser.html.twig");
    }


}