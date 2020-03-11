<?php


namespace App\Security;


use App\Entity\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTDecodeFailureException;
use Lexik\Bundle\JWTAuthenticationBundle\Exception\MissingTokenException;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Lexik\Bundle\JWTAuthenticationBundle\TokenExtractor\AuthorizationHeaderTokenExtractor;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class JwtTokenAuthenticator extends AbstractGuardAuthenticator
{
    private $message;
    private $jwtEncoder;
    private $em;
    private $request;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(JWTEncoderInterface $jwtEncoder, EntityManagerInterface $em, LoggerInterface $logger)
    {
        $this->jwtEncoder = $jwtEncoder;
        $this->em = $em;
        $this->logger = $logger;
    }

    public function getCredentials(Request $request)
    {
        $this->logger->info('getCredentials request: ' . $request);
        /*        $this->request =$request;
                $this->message = 'Ok';
                $extractor = new AuthorizationHeaderTokenExtractor(
                    'Bearer',
                    'Authorization'
                );
                $token = $extractor->extract($request);
                if (!$token) {
                    $this->message = 'Нет токена';
                    return;
                }
                $this->message = "Токен:  $token";
                return $token;*/
        return true;
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        $this->logger->info('getUser credentials: ' . $credentials);
        /*try {
            $data = $this->jwtEncoder->decode($credentials);
            //$this->message = $data;
        } catch (JWTDecodeFailureException $e) {
        }

        $username = $data['username'];
        */return $this->em
            ->getRepository(User::class)
            ->findOneBy(['email' => 'kosolapov-r@bk.ru']);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // do nothing - let the controller be called
    }

    public function supportsRememberMe()
    {
        return false;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        $this->logger->info('getCredentials request: ' . $request);
        return new JsonResponse([
            'error' => $this->request
        ], 401);
    }

    /**
     * @inheritDoc
     */
    public function supports(Request $request)
    {
        // TODO: Implement supports() method.
    }
}