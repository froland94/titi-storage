<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('/create', name: 'product.create')]
    public function create(
        Request $request,
        EntityManagerInterface $entityManager,
        TranslatorInterface $translator,
    ): Response|RedirectResponse
    {
        $product = new Product();
        $form = $this->createForm(ProductFormType::class, $product);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setUserId($this->getUser());
            $entityManager->persist($product);
            $entityManager->flush();

            $this->addFlash('success', $translator->trans('success.save', domain: 'product'));

            return $this->redirectToRoute('product.create');
        }

        return $this->render('product/index.html.twig', [
            'productForm' => $form,
        ]);
    }
}
