<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Contracts\Translation\TranslatorInterface;

class ProfileFormType extends AbstractType
{
    public function __construct(private readonly TranslatorInterface $translator) {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                    new Email(),
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ],
                'attr' => [
                    'placeholder' => $this->translator->trans('form.label.email', domain: 'profile')
                ],
                'label' => $this->translator->trans('form.label.email', domain: 'profile'),
                'disabled' => true,
            ])
            ->add('username', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ],
                'attr' => [
                    'placeholder' => $this->translator->trans('form.label.username', domain: 'profile'),
                ],
                'label' => $this->translator->trans('form.label.username', domain: 'profile'),
            ])
            ->add('update', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-secondary py-2 w-100 me-1 py-2 w-100 me-1'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'required' => false,
        ]);
    }
}
