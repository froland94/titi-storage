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

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a email.',
                    ]),
                    new Email([
                        'message' => 'This value is not a valid email address.',
                    ]),
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ],
                'attr' => [
                    'placeholder' => 'Email cím',
                ],
                'label' => 'Email cím',
            ])
            ->add('username', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a username.',
                    ]),
                ],
                'row_attr' => [
                    'class' => 'form-floating mb-3'
                ],
                'attr' => [
                    'placeholder' => 'Felhasználónév',
                ],
                'label' => 'Felhasználónév',
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
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
                    'placeholder' => 'Jelszó',
                    'autocomplete' => 'new-password',
                ],
                'label' => 'Jelszó',
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
                'label' => 'Elfogadom a felhasználási feltételeket.',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Regisztráció',
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
        ]);
    }
}
