<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


//        $builder
//            ->add('nickname', 'text', [
//                'disabled' => $options['is_edit']
//            ])
//            ->add('avatarNumber', 'choice', [
//                'choices' => [
//                    1 => 'Girl (green)',
//                    2 => 'Boy',
//                    3 => 'Cat',
//                    4 => 'Boy with Hat',
//                    5 => 'Happy Robot',
//                    6 => 'Girl (purple)',
//                ],
//                'description' => 'Choose one of the pre-made avatars by number'
//            ])
//            ->add('tagLine', 'textarea');
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => User::class,
            'csrf_protection' => false,
        ));
    }

    public function getName()
    {
        return 'user';
    }
}