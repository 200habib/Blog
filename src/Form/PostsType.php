<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Posts;
use App\Entity\tags;
use App\Entity\User;
use App\Entity\SubCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Count;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;


class PostsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('body')
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('Tags', EntityType::class, [
                'class' => tags::class,
                'choice_label' => 'name', 
                'multiple' => true,  
                'expanded' => true,  
                'required' => false,
                'constraints' => [
                    new Count([
                        'min' => 1,  
                        'max' => 5,  
                        'maxMessage' => 'You can select up to {{ limit }} tags.',
                        'minMessage' => 'Please select at least {{ limit }} tag.',
                    ]),
                ],
            ])
            ->add('Category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
            ])
            ->add('SubCategory', EntityType::class, [
                'class' => SubCategory::class,
                'choice_label' => 'name',
            ])
            ->add('imageFile', FileType::class, [
                'label' => 'Upload Image',
                'required' => false,
                'mapped' => true, // Mappato all'entità
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file (JPEG, PNG, GIF).',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Posts::class,
        ]);
    }
}
