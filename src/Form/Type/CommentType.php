<?php

namespace NanarStore\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('content', 'textarea');
		$builder->add('grade', 'text');
    }

    public function getName()
    {
        return 'comment';
    }
}