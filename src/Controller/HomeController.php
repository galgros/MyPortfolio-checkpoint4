<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\VideoRepository;
use App\Service\MailerService;
use App\Service\TumblrService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @return Response
     * @Route("/", name="app")
     */
    public function index(Request $request, MailerService $mailerService): Response
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);
        $apiKey = $this->getParameter('google_api_key');

        if ($form->isSubmitted() && !empty($form->getData())) {
            $data = $form->getData();
            $mailerService->sendEmail($data);
        }

        return $this->render('app/index.html.twig', [
            'form' => $form->createView(),
            'apiKey' => $apiKey
            ]);
    }

    /**
     * @return Response
     * @Route("/dev", name="app_dev")
     */
    public function dev(): Response
    {
        return $this->render('app/dev.html.twig');
    }

    /**
     * @return Response
     * @Route("/music", name="app_music")
     */
    public function music(VideoRepository $videoRepository): Response
    {
        $video = $videoRepository->findOneBy([]);

        return $this->render('app/music.html.twig', [
            'video' => $video
            ]);

    }

    /**
     * @return Response
     * @Route("/gaming", name="app_gaming")
     */
    public function gaming(VideoRepository $videoRepository): Response
    {
        $video = $videoRepository->findOneBy([]);

        return $this->render('app/gaming.html.twig', [
            'video' => $video
        ]);

    }

    /**
     * @return Response
     * @Route("/video", name="app_video")
     */
    public function video(
        VideoRepository $videoRepository): Response
    {
        $video = $videoRepository->findOneBy([]);

        return $this->render('app/video.html.twig', [
            'video' => $video
        ]);

    }

    /**
     * @return Response
     * @Route("/picture", name="app_picture")
     */
    public function picture(TumblrService $tumblrService): Response
    {
        $images = $tumblrService->getImage();

        return $this->render('app/picture.html.twig',[
            'images' => $images
        ]);
    }
}
