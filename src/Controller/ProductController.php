<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/product')]
class ProductController extends AbstractController
{
    public function __construct(private readonly TranslatorInterface $translator) {}

    #[Route('/new', name: 'product.new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $entityManager
    ): Response|RedirectResponse
    {
        $product = new Product();
        $form = $this->createForm(ProductFormType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setUser($this->getUser());
            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success', $this->translator->trans('success.save', domain: 'product'));

            return $this->redirectToRoute('product.new');
        }

        return $this->render('product/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'product.edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Product $product, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProductFormType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'product.delete', methods: ['POST'])]
    public function delete(Request $request, Product $product, EntityManagerInterface $entityManager): JsonResponse
    {
        if ($this->isCsrfTokenValid('delete'.$product->getId(), $request->request->get('_token'))) {
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->json([
            'message' => $this->translator->trans('success.delete', domain: 'product'),
        ]);
    }

    #[Route('/add-stock/{id}', name: 'product.addStock', methods: ['POST'])]
    public function addStock(Product $product, EntityManagerInterface $entityManager): JsonResponse
    {
        $product->setInStock($product->getInStock() + 1);
        $entityManager->flush();

        return $this->json([
            'message' => $this->translator->trans('success.add_stock', domain: 'product'),
            'inStock' => $product->getInStock(),
            'success' => true,
        ]);
    }

    #[Route('/remove-stock/{id}', name: 'product.removeStock', methods: ['POST'])]
    public function removeStock(Product $product, EntityManagerInterface $entityManager): JsonResponse
    {
        if ($product->getInStock() === 0) {
            return $this->json([
                'success' => false,
                'message' => $this->translator->trans('success.out_of_stock', domain: 'product'),
                'inStock' => $product->getInStock(),
            ]);
        }

        $product->setInStock($product->getInStock() - 1);
        $entityManager->flush();

        return $this->json([
            'message' => $this->translator->trans('success.remove_stock', domain: 'product'),
            'inStock' => $product->getInStock(),
            'success' => true,
        ]);
    }
}
