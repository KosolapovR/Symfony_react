<?php


namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comment;
use App\Entity\User;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\Serializer\SerializerInterface;


class CommentController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/api/comment")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllCommentAction()
    {
        $data = $this->getDoctrine()->getRepository(Comment::class)->findAll();
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/api/comment/{id}")
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getCommentAction(int $id)
    {
        $data = $this->getDoctrine()->getRepository(Comment::class)->find($id);
        $view = $this->view($data, 200);

        return $this->handleView($view);
    }

    /**
     * @Rest\Post("/api/comment")
     * @param Request $request
     * @param Serializer $serializer
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function postCommentAction(Request $request, SerializerInterface $serializer)
    {

        $em = $this->getDoctrine()->getManager();

        $comment = new Comment();

        /** @var User $user */
        $user = $em->getRepository(User::class)->find($request->get('user_id'));
        $comment->setUser($user);

        /** @var Post $post */
        $post = $em->getRepository(Post::class)->find($request->get('post_id'));
        $comment->setPost($post);

        $comment->setText($request->get('text'));

        $comment->setDateAt(new \DateTime('now'));
        //$em->persist($user);
        //$em->flush();

        $json = $serializer->serialize($comment, 'json');

        $view = $this->view($json, 201);
        return $this->handleView($view);
    }

    /**
     * @param int $id
     * @Rest\Delete("/api/comment/{id}")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteCategortAction(int $id)
    {
        $em = $this->getDoctrine()->getManager();

        $comment = $em->getRepository(Comment::class)->find($id);
        if (!$comment) {
            $view = $this->view('User Not found', 404);
            return $this->handleView($view);
        } else {
            $em->remove($comment);
            //$em->flush();
            $view = $this->view('ok', 200);
            return $this->handleView($view);
        }
    }
}