<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/api/login", name="login", methods={"POST"})
     */
    public function loginAction(Request $request)
    {
        $user = $this->getUser();

        return $this->json([
            'username' => $user->getName(),
            'roles' => $user->getRoles(),
        ]);
    }
}