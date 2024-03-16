<?php

namespace App\Form;

use App\Entity\Product;
use App\Enum\ProductUnit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'min' => 0,
                ],
            ])
            ->add('description', TextareaType::class, [
                'required' => false,
            ])
            ->add('inStock', IntegerType::class, [
                'attr' => [
                    'min' => 0,
                ],
            ])
            ->add('unit', EnumType::class, [
                'class' => ProductUnit::class,
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
            'translation_domain' => 'product',
            'label_format' => 'form.%name%',
        ]);
    }
}
