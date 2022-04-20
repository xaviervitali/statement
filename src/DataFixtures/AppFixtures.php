<?php



namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Skill;
use Doctrine\Persistence\ObjectManager;

use Doctrine\Bundle\FixturesBundle\Fixture;



class AppFixtures extends AbstractFixture

{







    public function loadData(ObjectManager $manager)

    {

        $this->createMany(Category::class, 5, function (Category $category) {
            $category->setTitle($this->faker->words(3, true));
        });

        $this->createMany(Skill::class, rand(2, 50), function (Skill $skill) {
            $skill->setTitle($this->faker->words(3, true))
                ->setComments($this->faker->paragraph())
                ->setCategory($this->getRandomreference(Category::class));
        });
    }


    public function getDependencies()

    {

        return [UserFixtures::class];
    }
}
