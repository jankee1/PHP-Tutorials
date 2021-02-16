<?php

namespace App\Form;

use App\Entity\Video;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class VideoFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('filename')
            ->add('size')
            ->add('description')
            ->add('title', TextType::class, [
              'label' => 'Video title',
              'data' => 'Example title',
              'required' => false
            ])
            // ->add('created_at', DateType::class, [
            //   'label' => 'Set date',
            //   'widget' => 'single_text'
            // ])
            ->add('format')
            ->add('duration')
            ->add('agreeTerms', CheckboxType::class, [
              'label' => 'Agree ?',
              'mapped' => false //very important!!!! setting it to false we make sure that it is not mapped to entity when we will try to send a form
            ])
            ->add('file', FileType::class, [
              'label' => 'Video (MP4 file)'
            ])
            ->add('save', SubmitType::class, [
              'label' => 'Add a video'
            ])
            // ->add('author')
            // ->add('user')
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
          $video = $event->getData();
          $form = $event->getForm();

          if(!$video || null === $video->getId()) {
            $form->add('created_at', DateType::class, [
              'label' => 'Set Date',
              'widget' => 'single_text'
            ]);
          }
        });

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Video::class,
        ]);
    }
}
