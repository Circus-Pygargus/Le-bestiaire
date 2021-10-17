<?php

namespace App\Form;

use App\Entity\Movie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CreateMovieFormTYpe extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'required'=> true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Tu dois entrer un nom pour cette vidéo'
                    ])
                ]
            ])
            ->add('movieFile', VichImageType::class, [
                'label' => 'Vidéo',
                'required' => true,
                'constraints' => [
                    new NotNull([
                        'message' => 'Tu dois ajouter une vidéo'
                    ]),
                    new File([
                        'maxSize' => '50M',
                        'mimeTypes' => [
                            "video/mp4"
                        ],
                        'mimeTypesMessage' => 'Seuls les fichiers de type mp4 sont acceptés'
                    ])
                ]
            ])
            ->add('alt', TextType::class, [
                'label' => 'Texte alternatif',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Tu dois entrer un texte alternatif'
                    ])
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data-class' => Movie::class
        ]);
    }
}
