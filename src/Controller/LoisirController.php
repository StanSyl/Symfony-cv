<?php

// src/Controller/LuckyController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Loisir;
use App\Form\LoisirType;

class LoisirController extends Controller
{
    public function create()
    {
        $loisir = new Loisir();
        $form = $this->createForm(LoisirType::class, $loisir);

        return $this->render(
            'loisir/create.html.twig',
            [
                'entity' => $loisir,
                'form' => $form->createView(),
            ]
        );
    }

    public function validCreate(Request $request)
    {
        $loisir = new Loisir();
        $form = $this->createForm(LoisirType::class, $loisir);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $loisir = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($loisir);
            $entityManager->flush();

            return $this->redirectToRoute('app_lucky_number');
        }

        return $this->render(
            'loisir/create.html.twig',
            [
                'entity' => $loisir,
                'form' => $form->createView(),
            ]
        );
    }

    public function edit($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $loisir = $entityManager->getRepository(loisir::class)->findOneBy(['id' => $id]);
        $form = $this->createForm(LoisirType::class, $loisir);

        return $this->render(
            'loisir/edit.html.twig',
            [
                'entity' => $loisir,
                'form' => $form->createView(),
            ]
        );
    }

    public function validEdit(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $loisir = $entityManager->getRepository(loisir::class)->findOneBy(['id' => $id]);
        $form = $this->createForm(LoisirType::class, $loisir);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $loisir = $form->getData();

            $entityManager->persist($loisir);
            $entityManager->flush();

            return $this->redirectToRoute('app_lucky_number');
        }

        return $this->render(
            'loisir/edit.html.twig',
            [
                'entity' => $loisir,
                'form' => $form->createView(),
            ]
        );
    }

    public function deleteLoisir($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $loisir = $entityManager->getRepository(Loisir::class)->findOneBy(['id' => $id]);
        $entityManager->remove($loisir);
        $entityManager->flush();

        return $this->redirectToRoute('app_lucky_number');
    }
}
