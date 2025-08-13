<?php

namespace App\Form;

use App\Entity\alcohol;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlcoholSelectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('alcohols', EntityType::class, [
                'class' => alcohol::class,
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
