<?php

namespace Dim\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Dim\BlogBundle\Form\CategoryType;

class ArticleType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('createdAt', DateTimeType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('updatedAt', DateTimeType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('display', CheckboxType::class, [
                'label'    => 'Publier',
                'required' => false,
                //'attr' => ['class' => 'col-10']
            ])
            ->add('categories', EntityType::class, [
                'class' => 'DimBlogBundle:Category',
                'placeholder' => 'Catégorie',
                'choice_label' => 'wording',
                'multiple' => true,
                'required' => false,
                'attr' => ['class' => 'form-control']
            ])
            ->add('user', EntityType::class, [
                'class' => 'DimUserBundle:User',
                'placeholder' => 'Auteur',
                'choice_label' => 'username',
                'attr' => ['class' => 'form-control']
            ])
            ->add('media')
        ;

    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dim\BlogBundle\Entity\Article'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'dim_blogbundle_article';
    }


}
