<?php

namespace App\Controller;

use App\Entity\BusDate;
use App\Form\BusDateType;
use App\Repository\BusDateRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/bus/date')]
class BusDateController extends AbstractController
{
    #[Route('/', name: 'app_bus_date_index', methods: ['GET'])]
    public function index(BusDateRepository $busDateRepository): Response
    {
        return $this->render('bus_date/index.html.twig', [
            'bus_dates' => $busDateRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bus_date_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $busDate = new BusDate();
        $form = $this->createForm(BusDateType::class, $busDate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($busDate);
            $entityManager->flush();

            return $this->redirectToRoute('app_bus_date_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bus_date/new.html.twig', [
            'bus_date' => $busDate,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bus_date_show', methods: ['GET'])]
    public function show(BusDate $busDate): Response
    {
        return $this->render('bus_date/show.html.twig', [
            'bus_date' => $busDate,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bus_date_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BusDate $busDate, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BusDateType::class, $busDate);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_bus_date_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('bus_date/edit.html.twig', [
            'bus_date' => $busDate,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bus_date_delete', methods: ['POST'])]
    public function delete(Request $request, BusDate $busDate, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$busDate->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($busDate);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_bus_date_index', [], Response::HTTP_SEE_OTHER);
    }
}
