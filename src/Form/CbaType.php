<?php

namespace App\Form;

use App\Entity\Cba;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CbaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('no_of_comm')
            ->add('document_code')
            ->add('bearer_of_letter')
            ->add('date_receive', null, [
                'widget' => 'single_text',
            ])
            ->add('time_receive')
            ->add('receiving_staff')
            ->add('letter_sender')
            ->add('office_designation')
            ->add('date_of_the_letter', null, [
                'widget' => 'single_text',
            ])
            ->add('content_of_the_letter')
            ->add('other_note')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cba::class,
        ]);
    }
}
