<?php

namespace App\Form;

use App\Entity\Post;
use App\Form\Type\WorkflowType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('slug', TextType::class)
            ->add('description', TextareaType::class)
            ->add('text', TextareaType::class)
            ->add('image', FileType::class)
            ->add('status', WorkflowType::class, [
                'placeholder' => 'Choose a article status option', ])
            ->add('createdAt', DateTimeType::class)
            ->add('modifiedAt', DateTimeType::class)
            ->add('publishedAt', DateTimeType::class)
            ->add('authorId', NumberType::class)
            ->add('save', SubmitType::class, ['label' => 'Create Post', 'attr' => ['class' => 'btn btn-default pull-right']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
