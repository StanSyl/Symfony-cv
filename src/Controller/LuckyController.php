<?php

// src/Controller/LuckyController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Experience;
use App\Entity\Formation;
use App\Entity\Loisir;

class LuckyController extends Controller
{
    public function number()
    {
        $number = random_int(0, 100);

        $forma = $this->getDoctrine()
        ->getRepository(Formation::class)
        ->findAll();

        $exp = $this->getDoctrine()
        ->getRepository(Experience::class)
        ->findAll();

        $loi = $this->getDoctrine()
        ->getRepository(Loisir::class)
        ->findAll();

        return $this->render('lucky/number.html.twig', [
            'number' => $number,
            'name' => 'Jhon RAMBO',
            'job' => 'Soldat expérimenté',
            'formations' => $forma,
            'experiences' => $exp,
            'loisirs' => $loi,
        ]);
    }

    public function connect()
    {
        return $this->redirectToRoute('app_lucky_number');
    }
}
