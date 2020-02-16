<?php


namespace App\Controller;

use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;


class UserController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/api/users")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllUsersAction()
    {
        $data = $this->getDoctrine()->getRepository(User::class)->findAll();
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/api/users/{id}")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getUserAction(int $id)
    {
        $data = $this->getDoctrine()->getRepository(User::class)->find($id);
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @Rest\Post("/api/users")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postUserAction(Request $request)
    {
        $content = $request->get('password');

        $em = $this->getDoctrine()->getManager();
        $user = new User();
        $user->setPassword($content);

        $view = $this->view($content, 201);
        return $this->handleView($view);
    }


}