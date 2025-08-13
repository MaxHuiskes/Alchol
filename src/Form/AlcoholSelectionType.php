<?php

namespace App\Form;

use App\Entity\Alchole;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlcoholSelectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('alcholes', EntityType::class, [
                'class' => Alchole::class,
                'choice_label' => 'name',
                'multiple' => true,
                'expanded' => true, // makes checkboxes
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
