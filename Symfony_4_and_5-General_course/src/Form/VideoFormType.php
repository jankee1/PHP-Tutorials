<?php

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VideoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('filename')
            // ->add('size')
            // ->add('description')
            ->add('title', TextType::class, [
              'label' => 'Video title',
              'data' => 'Example title',
              'required' => false
            ])
            ->add('created_at', DateType::class, [
              'label' => 'Set date',
              'widget' => 'single_text'
            ])
            ->add('save', SubmitType::class, [
              'label' => 'Add a video'
            ])
            // ->add('format')
            // ->add('duration')
            // ->add('author')
            // ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
