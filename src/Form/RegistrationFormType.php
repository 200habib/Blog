<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;
use Karser\Recaptcha3Bundle\Form\Recaptcha3Type;
use Karser\Recaptcha3Bundle\Validator\Constraints\Recaptcha3;





class RegistrationFormType extends AbstractType
{

    use RegexTrait;
    private const STRONG_PASSWORD = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[#?!@$%^&*\-_]).{8,}$/';
    private const EMAIL_REGEX = '/(?:[a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z]{2,63}|(?:\[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\\\[\x01-\x09\x0b\x0c\x0e-\x7f])+))\])/i';


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class, [
            'label' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter an email address',
                ]),
                new Email([
                    'message' => 'Please enter a valid email address',
                ]),
                new Length([
                    'max' => 180,
                    'maxMessage' => 'The email should not exceed {{ limit }} characters',
                ]),
                new Regex([
                    'pattern' => self::EMAIL_REGEX,
                    'message' => 'The email address format is invalid according to RFC 5322 standards.',
                ]),
            ],
            'attr' => ['autocomplete' => 'email'],
        ])

        ->add('username', null, [
            'label' => 'Username',
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a username.',
                ]),
                new Length([
                    'min' => 3,
                    'max' => 50,
                    'minMessage' => 'Your username should be at least {{ limit }} characters long',
                    'maxMessage' => 'Your username cannot be longer than {{ limit }} characters',
                ]),
            ],
            'attr' => ['autocomplete' => 'username'],
        ])
        
            ->add('agreeTerms', CheckboxType::class, [
                'label' => false,
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])

            ->add('plainPassword', RepeatedType::class, [
                
                'type' => PasswordType::class,
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Regex(
                        self::STRONG_PASSWORD,
                        message: 'Le mot de passe doit contenir au minimum huit caractères, avec au moins une lettre majuscule, une lettre minuscule, un chiffre, et un caractère spécial (#?!@$ %^&*-_).'
                    )
                ],
                'invalid_message' => 'Les champs de mot de passe doivent correspondre.',
                'options' => ['attr' => ['class' => 'rounded-none rounded-e-lg bg-gray-50 border text-gray-900 focus:ring-blue-500 focus:border-blue-500 block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe *'],
                'second_options' => ['label' => 'Répétez le mot de passe *' ],
                // 'label' => false,
            ])
            // ->add('captcha', Recaptcha3Type::class, [
            //     'constraints' => new Recaptcha3(),
            //     'action_name' => 'Registration',
            //     'locale' => 'fr',
            // ])
            ;
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
