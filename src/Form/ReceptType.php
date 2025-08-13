<?php

namespace App\Form;

use App\Entity\Alcohol;
use App\Entity\Recept;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReceptType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('recept')
            ->add('alcohol', EntityType::class, [
            'class' => Alcohol::class,
            'choice_label' => 'name',
            'label' => 'Ingridients',
            'multiple' => true,
            'expanded' => true,
            'query_builder' => function (\Doctrine\ORM\EntityRepository $er) {
                return $er->createQueryBuilder('a')
                        ->orderBy('a.name', 'ASC'); // alphabetical order
            },
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recept::class,
        ]);
    }
}
