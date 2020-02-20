<?php


namespace App\Controller;

use App\Entity\Category;
use App\Entity\Message;
use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Serializer\SerializerInterface;


class MessageController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/api/message")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllMessageAction()
    {
        $data = $this->getDoctrine()->getRepository(Message::class)->findAll();
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/api/message/{id}")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getMessageAction(int $id)
    {
        $data = $this->getDoctrine()->getRepository(Message::class)->find($id);
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @Rest\Post("/api/message")
     * @param Request $request
     * @param Serializer $serializer
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function postMessageAction(Request $request, SerializerInterface $serializer)
    {

        $em = $this->getDoctrine()->getManager();

        $message = new Message();

        /** @var User $user */
        $user = $em->getRepository(User::class)->find($request->get('user_id'));
        $message->setUser($user);

        $message->setDateAt(new \DateTime('now'));
        //$em->persist($user);
        //$em->flush();

        $json = $serializer->serialize($message, 'json');

        $view = $this->view($json, 201);
        return $this->handleView($view);
    }

    /**
     * @param int $id
     * @Rest\Delete("/api/message/{id}")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteCategortAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();

        $message = $em->getRepository(Message::class)->find($id);
        if (!$message) {
            $view = $this->view('User Not found', 404);
            return $this->handleView($view);
        } else {
            $em->remove($message);
            //$em->flush();
            $view = $this->view('ok', 200);
            return $this->handleView($view);
        }
    }
}