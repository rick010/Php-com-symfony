<?php

namespace App\Controller;

use App\Entity\Conta;
use App\Entity\TipoConta;
use App\Form\ContaType;
use App\Repository\ContaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/conta')]
class ContaController extends AbstractController
{
    #[Route('/', name: 'app_conta_index', methods: ['GET'])]
    public function index(ContaRepository $contaRepository): Response
    {
        return $this->render('conta/index.html.twig', [
            'contas' => $contaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_conta_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ContaRepository $contaRepository): Response
    {
        $contum = new Conta();
        

        $form = $this->createForm(ContaType::class, $contum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contum->setStatus = true;
            $contum->setCreated(new \DateTime());
            $contum->setNumeroConta(rand(100000, 999999));
            $contaRepository->save($contum, true);

            return $this->redirectToRoute('app_conta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conta/new.html.twig', [
            'contum' => $contum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conta_show', methods: ['GET'])]
    public function show(Conta $contum): Response
    {
        return $this->render('conta/show.html.twig', [
            'contum' => $contum,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_conta_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Conta $contum, ContaRepository $contaRepository): Response
    {
        $form = $this->createForm(ContaType::class, $contum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contaRepository->save($contum, true);

            return $this->redirectToRoute('app_conta_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conta/edit.html.twig', [
            'contum' => $contum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conta_delete', methods: ['POST'])]
    public function delete(Request $request, Conta $contum, ContaRepository $contaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contum->getId(), $request->request->get('_token'))) {
            $contaRepository->remove($contum, true);
        }

        return $this->redirectToRoute('app_conta_index', [], Response::HTTP_SEE_OTHER);
    }
}
