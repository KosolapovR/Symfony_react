<?php


namespace App\Controller;

use App\Entity\Category;
use App\Entity\Records;
use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Serializer\SerializerInterface;


class RecordsController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/api/records")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllRecordsAction()
    {
        $data = $this->getDoctrine()->getRepository(Records::class)->findAll();
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/api/records/{id}")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getRecordsAction(int $id)
    {
        $data = $this->getDoctrine()->getRepository(Records::class)->find($id);
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @Rest\Post("/api/records")
     * @param Request $request
     * @param Serializer $serializer
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function postRecordsAction(Request $request, SerializerInterface $serializer)
    {

        $em = $this->getDoctrine()->getManager();

        $records = new Records();

        /** @var User $user */
        $user = $em->getRepository(User::class)->find($request->get('user_id'));
        $records->setUser($user);

        /** @var Category $category */
        $category = $em->getRepository(Category::class)->find($request->get('category_id'));
        $records->setCategory($category);

        $records->setDate(new \DateTime('now'));
        //$em->persist($user);
        //$em->flush();

        $json = $serializer->serialize($records, 'json');

        $view = $this->view($json, 201);
        return $this->handleView($view);
    }

    /**
     * @param int $id
     * @Rest\Delete("/api/records/{id}")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteCategortAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();

        $records = $em->getRepository(Records::class)->find($id);
        if (!$records) {
            $view = $this->view('User Not found', 404);
            return $this->handleView($view);
        } else {
            $em->remove($records);
            //$em->flush();
            $view = $this->view('ok', 200);
            return $this->handleView($view);
        }
    }
}