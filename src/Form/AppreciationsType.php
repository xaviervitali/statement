<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Competence;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppreciationsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("competences", EntityType::class, [
                "class" => Competence::class,
                "choice_label" => "nom"
            ])
            ->add(
                "appreciations",
                CollectionType::class,
                [
                    "entry_type" => AppreciationType::class,
                    'by_reference' => false,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
