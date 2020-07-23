<?php

namespace App\DataFixtures;

use App\Entity\Video;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VideoFixtures extends Fixture
{
    const MUSICVIDEO = [
        ['Mr Sample - Motel Room Bass Solo', 'https://www.youtube.com/watch?v=i0wVfKWSKcc'],
        ['Mr Sample: Untitled Trap Live', 'https://www.youtube.com/watch?v=sPvYV86QDgg'],
        ['KYKS x Mr Sample - Live Session #4 ( Loup )', 'https://www.youtube.com/watch?v=osEkyz9XL_E'],
        ['Mr Sample Live @Radiocanut', 'https://www.youtube.com/watch?v=QV2ha2rORQ8'],
        ['Snitch x Mr Sample - Live Session #3', 'https://www.youtube.com/watch?v=lxAb6QnNodQ'],
        ['KYKS x Mr Sample - Live Session #2', 'https://www.youtube.com/watch?v=b8RcWokv7Iw'],
        ['Dylon Dyzzy x Mr Sample - Live Session #1', 'https://www.youtube.com/watch?v=jPBBGF4Dyrg'],
        ['Bouga - Belsunce Breakdown ( Mr Sample Remix )', 'https://www.youtube.com/watch?v=FtuuZJNXLks'],
        ['Mr Sample - Footwerk / Trap Mixtape (Live Janvier 2015)', 'https://www.youtube.com/watch?v=vaaAC0TwSo0'],
        ['Mr Sample - The Judgment (LiveVersion on APC40)', 'https://www.youtube.com/watch?v=n084gSJGn1g'],
        ['Mr Sample - FLECHE Ft Fat Bass Ninja (LiveVersion on APC40)', 'https://www.youtube.com/watch?v=rBoAirduckQ'],
    ];

    const GAMEVIDEO = [
        ['(FR) Portal 2, le plus vite possible // Pb : 1:54:58', 'https://www.youtube.com/watch?v=FrzCvmZi01o'],
        ['(FR) VALORANT, nouveau jeu de l\'angoisse ?! Oui !', 'https://www.youtube.com/watch?v=NXjisENhjZ8'],
        ['(FR) DOOM ETERNAL DANS TA FACE [Chill/Blabla]', 'https://www.youtube.com/watch?v=TyJUafP_aik'],
        ['(FR) Sam & Max Hit the Road // On mène l\'enquête 3/4', 'https://www.youtube.com/watch?v=VLWfd_GGqfE'],
        ['(FR) Sam & Max Hit the Road // On mène l\'enquête 4/4', 'https://www.youtube.com/watch?v=KM1Gug-xnUI'],
        ['(FR) GeoGuessr encore une game 25000 points ! Incroyable !', 'https://www.youtube.com/watch?v=wfgWf7G7wXQ'],
        ['(FR) The Binding of Isaac, On bourre Cain et on est aidé', 'https://www.youtube.com/watch?v=rkb62HjNvHE'],
        ['(FR) Découverte : Trover saves the Universe [2/3] (Pour public averti)', 'https://www.youtube.com/watch?v=iADT7IQgOpM'],
        ['(FR) GeoGuessr, et vive la Russie !', 'https://www.youtube.com/watch?v=vgX-bWYLDnk'],
    ];

    const LOLVIDEO = [
        ['Philippe Poutou contre les forces du mal (Vostfr)', 'https://www.youtube.com/watch?v=ZlmQ4PQZVzk'],
        ['Motus - Eliette pète en direct à la Télé ( FDP Production Remix )', 'https://www.youtube.com/watch?v=pi7u3DkzlHI']
    ];

    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function load(ObjectManager $manager)
    {
        $categories = $this->categoryRepository->findAll();

        for ($i=0; $i<count(self::LOLVIDEO); $i++) {
            $lolVideo[$i] = new Video();
            $lolVideo[$i]->setTitle(self::LOLVIDEO[$i][0])
                ->setLink(self::LOLVIDEO[$i][1])
                ->setCategory($categories[2])
                ->setCreatedAt(date_create('now'));
            $manager->persist($lolVideo[$i]);
        }

        for ($i=0; $i<count(self::MUSICVIDEO); $i++) {
            $musicVideo[$i] = new Video();
            $musicVideo[$i]->setTitle(self::MUSICVIDEO[$i][0])
                ->setLink(self::MUSICVIDEO[$i][1])
                ->setCategory($categories[0])
                ->setCreatedAt(date_create('now'));
            $manager->persist($musicVideo[$i]);
        }

        for ($i=0; $i<count(self::GAMEVIDEO); $i++) {
            $gameVideo[$i] = new Video();
            $gameVideo[$i]->setTitle(self::GAMEVIDEO[$i][0])
                ->setLink(self::GAMEVIDEO[$i][1])
                ->setCategory($categories[1])
                ->setCreatedAt(date_create('now'));
            $manager->persist($gameVideo[$i]);
        }

        $manager->flush();
    }
}
