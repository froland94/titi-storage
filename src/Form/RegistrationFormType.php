<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Contracts\Translation\TranslatorInterface;

class RegistrationFormType extends AbstractType
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
                    'placeholder' => $this->translator->trans('form.label.email', domain: 'registration')
                ],
                'label' => $this->translator->trans('form.label.email', domain: 'registration'),
            ])
            ->add('username', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ],
                'attr' => [
                    'placeholder' => $this->translator->trans('form.label.username', domain: 'registration'),
                ],
                'label' => $this->translator->trans('form.label.username', domain: 'registration'),
            ])
            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ],
                'attr' => [
                    'placeholder' => $this->translator->trans('form.label.password', domain: 'registration'),
                    'autocomplete' => 'new-password',
                ],
                'label' => $this->translator->trans('form.label.password', domain: 'registration'),
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue(),
                ],
                'label' => $this->translator->trans('form.label.terms', domain: 'registration'),
            ])
            ->add('submit', SubmitType::class, [
                'label' => $this->translator->trans('form.button.register', domain: 'registration'),
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
