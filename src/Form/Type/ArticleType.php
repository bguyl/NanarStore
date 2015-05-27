<?php

namespace NanarStore\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
          ->add('title', 'text')
          ->add('description', 'textarea')
			    ->add('category', 'text')
			    ->add('image', 'text')
			    ->add('price', 'text');
    }

    public function getName()
    {
        return 'article';
    }
}
