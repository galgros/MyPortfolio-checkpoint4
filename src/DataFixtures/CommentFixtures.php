<?php

namespace App\DataFixtures;

use App\Entity\Commentary;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CommentFixtures extends Fixture
{
    const MESSAGE = [
        ['Bill','Super, j\'adore la musique'],
        ['Matthieu','I Love french Ricotta'],
        ['Mireille','Un long message, Un long message, Un long message, Un long message, Un long message, Un long message, Un long message, Un long message, Un long message, '],
        ['Jaques','Super Site !'],
    ];

    public function load(ObjectManager $manager)
    {

        for ($i = 0; $i < count(self::MESSAGE); $i++) {
            $comment[$i] = new Commentary();
            $comment[$i]->setName(self::MESSAGE[$i][0])
                ->setMessage(self::MESSAGE[$i][1])
                ->setCreatedAt(date_create('now'));
            $manager->persist($comment[$i]);
        }

        $manager->flush();
    }
}
