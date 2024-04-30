<?php

namespace App\Controller;

use App\Entity\DateEx;
use App\Form\DateExType;
use App\Repository\DateExRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/date/ex')]
class DateExController extends AbstractController
{
    #[Route('/', name: 'app_date_ex_index', methods: ['GET'])]
    public function index(DateExRepository $dateExRepository): Response
    {
        return $this->render('date_ex/index.html.twig', [
            'date_exes' => $dateExRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_date_ex_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $dateEx = new DateEx();
        $form = $this->createForm(DateExType::class, $dateEx);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($dateEx);
            $entityManager->flush();

            return $this->redirectToRoute('app_date_ex_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('date_ex/new.html.twig', [
            'date_ex' => $dateEx,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_date_ex_show', methods: ['GET'])]
    public function show(DateEx $dateEx): Response
    {
        return $this->render('date_ex/show.html.twig', [
            'date_ex' => $dateEx,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_date_ex_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, DateEx $dateEx, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DateExType::class, $dateEx);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_date_ex_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('date_ex/edit.html.twig', [
            'date_ex' => $dateEx,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_date_ex_delete', methods: ['POST'])]
    public function delete(Request $request, DateEx $dateEx, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dateEx->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($dateEx);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_date_ex_index', [], Response::HTTP_SEE_OTHER);
    }
}
