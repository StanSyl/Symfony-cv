<?php

// src/Controller/LuckyController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Contact;
use App\Form\ContactType;

class ContactController extends Controller
{
    public function create()
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        return $this->render(
            'Contact/create.html.twig',
            [
                'entity' => $contact,
                'form' => $form->createView(),
            ]
        );
    }

    public function validCreate(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('app_lucky_number');
        }

        return $this->render(
            'Contact/create.html.twig',
            [
                'entity' => $contact,
                'form' => $form->createView(),
            ]
        );
    }
}
