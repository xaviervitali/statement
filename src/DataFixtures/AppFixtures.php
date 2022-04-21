<?php



namespace App\DataFixtures;

use App\Entity\Appreciation;
use App\Entity\Categorie;
use App\Entity\Category;
use App\Entity\Competence;
use App\Entity\Level;
use App\Entity\Skill;
use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Bundle\FixturesBundle\Fixture;



class AppFixtures extends AbstractFixture

{







    public function loadData(ObjectManager $manager)

    {

        $this->createMany(User::class, 5, function (User $user, $i) {
            $user->setUsername("user" . $i)
                ->setPrenom($this->faker->firstNameMale())
                ->setNom($this->faker->lastName())
                ->setPassword("password");
        });

        $this->createMany(Categorie::class, 5, function (Categorie $category, $i) {
            $category->setNom("categorie " . $i);
        });

        $this->createMany(Competence::class, 50, function (Competence $skill, $i) {
            $skill->setNom("compétence " . $i)
                ->setAPropos($this->faker->paragraph(rand(1, 5)))
                ->setCategorie($this->getRandomreference(Categorie::class));
        });


        $this->createMany(Appreciation::class, 1000, function (Appreciation $level) {
            $date = DateTimeImmutable::createFromMutable($this->faker->dateTimeBetween('-4 week'));
            $level->setNiveau($this->faker->randomElement(["Non Acquis", "En cours", "Acquis"]))
                ->setAjouteLe($date)
                ->setCommentaire($this->faker->paragraph(rand(0, 2)))
                ->setCompetence($this->getRandomreference(Competence::class))
                ->setUser($this->getRandomreference(User::class));
        });
    }


    public function getDependencies()

    {

        return [UserFixtures::class];
    }
}
