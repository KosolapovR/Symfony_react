<?php


namespace App\Controller;

use App\Entity\Category;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Serializer\SerializerInterface;


class CategoryController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/api/category")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllCategoryAction()
    {
        $data = $this->getDoctrine()->getRepository(Category::class)->findAll();
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/api/category/{id}")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCategoryAction(int $id)
    {
        $data = $this->getDoctrine()->getRepository(Category::class)->find($id);
        $view = $this->view($data, 200);


        return $this->handleView($view);
    }

    /**
     * @Rest\Post("/api/category")
     * @param Request $request
     * @param Serializer $serializer
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function postCategoryAction(Request $request, SerializerInterface $serializer)
    {

        $em = $this->getDoctrine()->getManager();

        $category = new Category();
        $category->setName($request->get('name'));

        //$em->persist($user);
        //$em->flush();

        $json = $serializer->serialize($category, 'json');

        $view = $this->view($json, 201);
        return $this->handleView($view);
    }

    /**
     * @param int $id
     * @Rest\Delete("/api/category/{id}")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteCategortAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();

        $category = $em->getRepository(Category::class)->find($id);
        if (!$category) {
            $view = $this->view('User Not found', 404);
            return $this->handleView($view);
        } else {
            $em->remove($category);
            //$em->flush();
            $view = $this->view('ok', 200);
            return $this->handleView($view);
        }
    }
}