<?php


namespace App\Controller;

use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Serializer\SerializerInterface;


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
    public function getUserAction(int $id,  SerializerInterface $serializer)
    {
        $data = $this->getDoctrine()->getRepository(User::class)->find($id);
        $json = $serializer->serialize($data, 'json');
        $view = $this->view($json, 200);

        return $this->handleView($view);
    }

    /**
     * @Rest\Post("/api/users")
     * @param Request $request
     * @param Serializer $serializer
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function postUserAction(Request $request, SerializerInterface $serializer)
    {

        $em = $this->getDoctrine()->getManager();

        $user = new User();
        $user->setPassword($request->get('password'));
        $user->setDateAt(new \DateTime('now'));
        $user->setName($request->get('name'));
        $user->setRoles([$request->get('role')]);
        $user->setEmail($request->get('email'));
        $user->setDayOfBirth(new \DateTime($request->get('day_of_birth')));

        //$em->persist($user);
        //$em->flush();

        $json = $serializer->serialize($user, 'json');

        $view = $this->view($json, 201);
        return $this->handleView($view);
    }

    /**
     * @param int $id
     * @Rest\Delete("/api/users/{id}")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteUserAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository(User::class)->find($id);
        if (!$user) {
            $view = $this->view('User Not found', 404);
            return $this->handleView($view);
        } else {
            $em->remove($user);
            //$em->flush();
            $view = $this->view('ok', 200);
            return $this->handleView($view);
        }
    }
}