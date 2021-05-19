<?php

namespace App\Form;

use App\Entity\Checkout;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheckoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('email')
            //->add('number')
            //->add('address')
            //->add('name')

            //->add('status', HiddenType::class)
            ->add(
                'email',
                EmailType::class,
                [
                    'label' => 'email',
                ]
            )
            ->add(
                'number',
                TextType::class,
                [
                    'label' => 'Телефон',
                ]
            )
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Имя',
                ]
            )
            ->add(
                'address',
                TextType::class,
                [
                    'label'=>'Адрес'
                ]
            )
            ->add('sessionId', HiddenType::class);

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Checkout::class,
        ]);
    }
}
