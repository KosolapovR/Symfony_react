<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\Likes;
use App\Entity\Message;
use App\Entity\Post;
use App\Entity\Records;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $category = new Category();
            $records = new Records();
            $message = new Message();
            $comment = new Comment();
            $likes = new Likes();
            $post = new Post();

            $categories = ['Окулист', 'Невролог', 'Диетолог', 'Хирург', 'Кардиолог', 'Терапевт', 'Невролог', 'Психолог', 'Лор', 'Медсестра'];
            $category->setName($categories[$i]);

            $user->setName($faker->userName);
            $user->setDateAt($faker->dateTimeThisYear);
            $user->setDayOfBirth($faker->dateTimeBetween('-60 years', '-18 years'));
            $user->setEmail($faker->email);
            $user->setPassword($faker->password);
            $roles = ['ROLE_ADMIN', 'ROLE_DOCTOR'];
            $user->setRole($faker->randomElements($roles));
            $user->setCategory($category);

            $records->setCategory($category);
            $records->setDate($faker->dateTimeThisYear);
            $records->setUser($user);

            $message->setDateAt($faker->dateTimeThisYear);
            $message->setUser($user);

            $post->setText($faker->text());
            $post->setDateAt($faker->dateTimeThisYear);

            $likes->setDateAt($faker->dateTimeThisYear);
            $likes->setPost($post);
            $likes->setUser($user);

            $comment->setDateAt($faker->dateTimeThisYear);
            $comment->setText($faker->text());
            $comment->setPost($post);
            $comment->setUser($user);

            $manager->persist($category);
            $manager->persist($user);
            $manager->persist($records);
            $manager->persist($message);
            $manager->persist($post);
            $manager->persist($likes);
            $manager->persist($comment);

        }
        $manager->flush();

        // $product = new Product();
        // $manager->persist($product);


    }
}
