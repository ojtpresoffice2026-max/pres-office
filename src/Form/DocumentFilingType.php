<?php

namespace App\Form;

use App\Entity\DocumentFiling;
use App\Entity\shelf;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DocumentFilingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('document_no')
            ->add('document_status')
            ->add('filed_by')
            ->add('indexed_by')
            ->add('date_index', null, [
                'widget' => 'single_text',
            ])
            ->add('category', EntityType::class, [
                'class' => shelf::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DocumentFiling::class,
        ]);
    }
}
