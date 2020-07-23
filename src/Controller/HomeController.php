<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\ProjectRepository;
use App\Repository\VideoRepository;
use App\Service\MailerService;
use App\Service\Slugify;
use App\Service\TumblrService;
use Google_Service_YouTube;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Google_Client;

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
            $this->addFlash('success', 'Votre message a bien été envoyé');

            return $this->redirectToRoute('app');
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
    public function dev(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();

        return $this->render('app/dev.html.twig', [
            'projects' => $projects
        ]);
    }

    /**
     * @return Response
     * @Route("/project/{slug}", name="app_project")
     */
    public function project(ProjectRepository $projectRepository, string $slug): Response
    {
        $project = $projectRepository->findOneBy(['title' => $slug]);

        return $this->render('app/project.html.twig', [
            'project' => $project
        ]);
    }

    /**
     * @return Response
     * @Route("/music", name="app_music")
     */
    public function music(VideoRepository $videoRepository): Response
    {
        $videos = $videoRepository->findBy(['category' => 1]);

        return $this->render('app/music.html.twig', [
            'videos' => $videos
            ]);

    }

    /**
     * @return Response
     * @Route("/gaming", name="app_gaming")
     */
    public function gaming(VideoRepository $videoRepository): Response
    {
        $videos = $videoRepository->findBy(['category' => 2]);

        return $this->render('app/gaming.html.twig', [
            'videos' => $videos
        ]);

    }

    /**
     * @return Response
     * @Route("/video", name="app_video")
     */
    public function video(
        VideoRepository $videoRepository): Response
    {
        $videos = $videoRepository->findBy(['category' => 3]);

        return $this->render('app/video.html.twig', [
            'videos' => $videos
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
