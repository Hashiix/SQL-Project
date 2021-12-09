<?php

namespace App\Controller;

use App\Entity\Days;
use App\Entity\Sessions;
use App\Repository\DaysRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $days = $em->getRepository(Days::class)->findAll();
        $sessions = $em->getRepository(Sessions::class)->findWeekSessions();

        $dates = [];

        $monday = date("Y-m-d", strtotime("last monday"));


        return $this->render('home/index.html.twig', [
            'days'     => $days,
            'sessions' => $sessions,
        ]);
    }
}
