<?php

namespace App\Form;

use App\Entity\Cted;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CtedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('no_of_comm', TextType::class, ['required' => false])
            ->add('document_code', TextType::class, ['required' => false])
            ->add('bearer_of_letter', TextType::class, ['required' => false])
            ->add('date_receive', DateType::class, ['required' => false, 'widget' => 'single_text'])
            ->add('time_receive', TextType::class, ['required' => false])
            ->add('receiving_staff', TextType::class, ['required' => false])
            ->add('letter_sender', TextType::class, ['required' => false])
            ->add('office_designation', TextType::class, ['required' => false])
            ->add('date_of_the_letter', DateType::class, ['required' => false, 'widget' => 'single_text'])
            ->add('content_of_the_letter', TextareaType::class, ['required' => false])
            ->add('other_note', TextareaType::class, ['required' => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cted::class,
        ]);
    }
}
