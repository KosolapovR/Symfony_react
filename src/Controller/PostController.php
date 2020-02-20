<?php


namespace App\Controller;

use App\Entity\Post;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Serializer\SerializerInterface;


class PostController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/api/post")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllCategoryAction()
    {
        $data = $this->getDoctrine()->getRepository(Post::class)->findAll();
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/api/post/{id}")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getPostAction(int $id)
    {
        $data = $this->getDoctrine()->getRepository(Post::class)->find($id);
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @Rest\Post("/api/post")
     * @param Request $request
     * @param Serializer $serializer
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function postPostAction(Request $request, SerializerInterface $serializer)
    {

        $em = $this->getDoctrine()->getManager();

        $Post = new Post();
        $Post->setText($request->get('text'));
        $Post->setDateAt(new \DateTime('now'));
        //$em->persist($user);
        //$em->flush();

        $json = $serializer->serialize($Post, 'json');

        $view = $this->view($json, 201);
        return $this->handleView($view);
    }

    /**
     * @param int $id
     * @Rest\Delete("/api/post/{id}")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteCategortAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();

        $Post = $em->getRepository(Post::class)->find($id);
        if (!$Post) {
            $view = $this->view('User Not found', 404);
            return $this->handleView($view);
        } else {
            $em->remove($Post);
            //$em->flush();
            $view = $this->view('ok', 200);
            return $this->handleView($view);
        }
    }
}