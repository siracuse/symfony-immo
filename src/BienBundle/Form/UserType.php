<?php

namespace BienBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomUser', TextType::class, array('constraints' =>
                array(new NotBlank(), new Length(array('max' => 50)))))
            ->add('prenomUser', TextType::class, array('constraints' =>
                array(new NotBlank(), new Length(array('max' => 50)))))
            ->add('telUser', TextType::class, array('constraints' =>
                array(new NotBlank(), new Length(array('max' => 10, 'min' => 10)))))
            ->add('adresse', adresseType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BienBundle\Entity\User'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bienbundle_user';
    }


}
