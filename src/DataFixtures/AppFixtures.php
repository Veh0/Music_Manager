<?php


namespace App\DataFixtures;


use App\Entity\Album\Album;
use App\Entity\Artist\Artist;
use App\Entity\Media\CD;
use App\Entity\Media\File;
use App\Entity\Media\Vinyle;
use App\Entity\Track\Track;
use App\Entity\Media\Medium;
use App\Repository\MediumRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{

    protected static $musicStyle = [
        'Rap',
        'Rock',
        'Country',
        'Metal',
        'Grunge'
    ];

    public function load(ObjectManager $manager)
    {
        $media = $manager->getRepository(MediumRepository::class)->findAll();
        // TODO: Implement load() method.
        $faker = Factory::create();

        // Artist Fixtures
        for ($i = 0; $i <= 10; $i++) {
            $artist = new Artist();

            $artist->setName($faker->firstName." ".$faker->lastName)
                ->setStyle($faker->randomElement(self::$musicStyle));

            self::loadAlbums($manager, $artist, $faker, $media);

            $manager->persist($artist);
        }
        $manager->flush();
    }

    static function loadAlbums(ObjectManager $manager, Artist $artist, $faker, array $media)
    {
        for ($i = 0; $i <= 2; $i++)
        {
            $album = new Album();

            $medium = $faker->randomElement($media);

            $album->setTitle($faker->sentence($nbWords = 4, $variableNbWords = true))
                ->addMedium($medium);

            $artist->addAlbum($album);

            self::loadTracks($manager, $album, $faker);

            $manager->persist($album);
        }
    }

    static function loadTracks(ObjectManager $manager, Album $album, $faker)
    {
        for ($i = 0; $i <= 12; $i++)
        {
            $track = new Track();

            $track->setTitle($faker->sentence($nbWords = 4, $variableNbWords = true))
                ->setDuration(rand(120, 360))
                ->setArtist($album->getArtist());

            $album->addTrack($track);

            $track->addMedium();

            $manager->persist($track);
        }
    }

}