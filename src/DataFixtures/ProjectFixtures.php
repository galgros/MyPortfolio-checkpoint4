<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $projectRocket = new Project();
        $projectRocket->setTitle('Rocket School')
            ->setDescription('Création du site web durant la formation Wild Code School')
            ->setMore('Team: , Stack: ')
            ->setImage('rocket.png');
        $manager->persist($projectRocket);

        $projectRetro = new Project();
        $projectRetro->setTitle('Retro Invaders')
            ->setDescription('Création du site web durant la formation Wild Code School')
            ->setMore('Team: , Stack: ')
            ->setImage('retro.png');
        $manager->persist($projectRetro);

        $projectDocto = new Project();
        $projectDocto->setTitle('DoctoPet')
            ->setDescription('Création du site web durant la formation Wild Code School')
            ->setMore('Team: , Stack: ')
            ->setImage('docto2.png');
        $manager->persist($projectDocto);

        $projectsbs = new Project();
        $projectsbs->setTitle('Side by Side')
            ->setDescription('Création du site web durant la formation Wild Code School')
            ->setMore('Team: , Stack: ')
            ->setImage('sbs.png');
        $manager->persist($projectsbs);

        $projectprtf = new Project();
        $projectprtf->setTitle('Portfolio')
            ->setDescription('Création du site web durant la formation Wild Code School')
            ->setMore('Team: , Stack: ')
            ->setImage('portf.png');
        $manager->persist($projectprtf);

        $manager->flush();
    }
}
