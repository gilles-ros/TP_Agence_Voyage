<?php

namespace App\Controller\Front;

use App\Entity\User;
use App\Entity\Client;
use App\Form\UserType;
use App\Form\ClientType;
use App\Entity\Destination;
use App\Entity\Produit;
use App\Repository\ConseillerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class FrontController extends AbstractController
{
    #[Route('/', name: 'app_front')]
    public function index(ConseillerRepository $conseillerRepository): Response
    {
        return $this->render('front/index.html.twig', [
            'conseillers' => $conseillerRepository->findAll(),
        ]);
    }

    #[Route('/inscription', name: 'inscription')]
    public function inscription(Request $request, UserPasswordHasherInterface $encoder, EntityManagerInterface $manager)
    {
        // Créer un Utilisateur
        $client = new Client();
        
        // Créer le formulaire
        $form = $this->createForm(ClientType::class, $client);
        
        // Remplir le formulaire avec les données
        $form->handleRequest($request);

        // Soumettre le formulaire (vérifiaction des champs)
        if ($form->isSubmitted() && $form->isValid()) {
            // Hashage des données
            $password = $encoder->hashPassword($client, $client->getPassword());
            // On rentre le mdp hashé dans les données de l'utilisateur
            $client->setPassword( $password );
            // dd($user);

            // Envoyer en BDD 
            $manager->persist($client);
            $manager->flush();
            
            // Redirect après inscription
            return $this->redirectToRoute('app_login');
        }

        // Return vers le template avec envoie du formulaire à la vue
        return $this->renderForm('front/inscription.html.twig', [
            'formClient' => $form
        ]);

    }

    #[Route('/destination/{id}', name: 'app_destination')]
    public function destination(Destination $destination): Response
    {
        return $this->render('front/destination.html.twig', [
            'destination' => $destination
        ]);
    }

    #[Route('/produit/{id}', name: 'app_produit')]
    public function produit(Produit $produit)
    {
        return $this->render('front/produit.html.twig', [
            'produit' => $produit
        ]);
    }

}
