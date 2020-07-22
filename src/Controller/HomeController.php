<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @return Response
     * @Route("/", name="home")
     */
    public function index(Request $request): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        $apiKey = $this->getParameter('google_api_key');

        if ($form->isSubmitted() && !empty($form->getData())) {
            $data = $form->getData();
        }

        return $this->render('home/index.html.twig', [
            'form' => $form->createView(),
            'apiKey' => $apiKey
            ]);
    }
}