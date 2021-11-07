<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Image;
use App\Repository\CategoryRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image as ImageConstraint;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CreateImageFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Tu dois entrer un nom pour cette image'
                    ])
                ]
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image',
                'required' => true,
                'constraints' => [
                    new NotNull([
                        'message' => 'Tu dois ajouter une image'
                    ]),
                    new ImageConstraint([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            "image/jpg",
                            "image/jpeg",
                            "image/png"
                        ],
                        'mimeTypesMessage' => 'Seuls les fichiers de type jpg, jpeg et png sont autorisés'
                    ])
                ]
            ])
            ->add('alt', TextType::class, [
                'label' => 'Texte alternatif',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Tu dois entrer un texte alternatif pour cette image'
                    ])
                ]
            ])
            ->add('featuredForCategory', EntityType::class, [
                'label' => 'Représente la catégorie',
                'required' => false,
                'class' => Category::class,
                'query_builder' => function (CategoryRepository $categoryRepository) {
                    return $categoryRepository->createQueryBuilder('c')
                        ->where('c.featuredImage is null')
                        ->orderBy('c.name', 'ASC');
                },
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => false,
            ])
            ->add('submit', SubmitType::class, [
            'label' => 'Enregistrer'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data-class' => Image::class
        ]);
    }
}
