<?php

namespace App\AcmeBundle\Controller;

use App\AcmeBundle\Entity\Test;
use App\AcmeBundle\Form\TestFormType;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TestController extends AbstractController
{

    protected $logger;


    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/test", name="test")
     */
    public function index()
    {
        if ($this->get("security.authorization_checker")->isGranted("TEST_ADD")) {
            $this->logger->warn('test');
        }
        $testE = new Test();

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
            'testEntity' => $testE
        ]);
    }

    public function formAction(Request $request)
    {
        $testE = new Test();
        $form = $this->createForm(TestFormType::class, $testE, array());
        $form->add('submit', SubmitType::class, array(
            'label' => 'preview',
        ));

        $form->handleRequest($request);
        $logger = $this->get('monolog.logger');
        if ($form->isSubmitted() && $form->isValid()) {
            $logger->info('Form valid');
        }

        return $this->render('test/form.html.twig', [
            'controller_name' => 'TestController',
            'testEntity' => $testE
        ]);
    }
}
