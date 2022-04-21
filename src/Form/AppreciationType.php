<?php

namespace App\Form;

use App\Entity\Appreciation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AppreciationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('niveau', ChoiceType::class, [
                "choices" => [
                    "Acquis" => "Acquis",
                    "En cours final d'aquisition" => "En cours final d'aquisition",
                    "En cours d'aquisition" => "En cours d'aquisition",
                    "Non Acquis" => "Non Acquis",
                    "Autre" => "Autre"
                ],
                "expanded" => true,
                "attr" => ["class" => "form-control"]
            ])
            ->add('commentaire', TextType::class, [
                "label" => "Commentaire",
                "attr" => ["class" => "form-control", "placeholder" => "Commentaire"]
            ])
            ->add("competence");
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Appreciation::class,
        ]);
    }
}
