<?php


namespace App\Controller;

use App\Entity\Post;
use App\Entity\Likes;
use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Serializer\SerializerInterface;


class LikesController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/api/likes")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllLikesAction()
    {
        $data = $this->getDoctrine()->getRepository(Likes::class)->findAll();
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/api/likes/{id}")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getLikesAction(int $id)
    {
        $data = $this->getDoctrine()->getRepository(Likes::class)->find($id);
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @Rest\Post("/api/likes")
     * @param Request $request
     * @param Serializer $serializer
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function postLikesAction(Request $request, SerializerInterface $serializer)
    {

        $em = $this->getDoctrine()->getManager();

        $likes = new Likes();

        /** @var User $user */
        $user = $em->getRepository(User::class)->find($request->get('user_id'));
        $likes->setUser($user);

        /** @var Post $post */
        $post = $em->getRepository(Post::class)->find($request->get('post_id'));
        $likes->setPost($post);
        
        $likes->setDateAt(new \DateTime('now'));
        //$em->persist($user);
        //$em->flush();

        $json = $serializer->serialize($likes, 'json');

        $view = $this->view($json, 201);
        return $this->handleView($view);
    }

    /**
     * @param int $id
     * @Rest\Delete("/api/likes/{id}")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteCategortAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();

        $likes = $em->getRepository(Likes::class)->find($id);
        if (!$likes) {
            $view = $this->view('User Not found', 404);
            return $this->handleView($view);
        } else {
            $em->remove($likes);
            //$em->flush();
            $view = $this->view('ok', 200);
            return $this->handleView($view);
        }
    }
}