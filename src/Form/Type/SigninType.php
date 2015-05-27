<?php

namespace NanarStore\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class SigninType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text')
            ->add('password', 'repeated', array(
                'type'            => 'password',
                'invalid_message' => 'The password fields must match.',
                'options'         => array('required' => true),
                'first_options'   => array('label' => 'Password'),
                'second_options'  => array('label' => 'Repeat password'),)
            )
            ->add('mail', 'text');

    }

    public function getName()
    {
        return 'user';
    }
}
