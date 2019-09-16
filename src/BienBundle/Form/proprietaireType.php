<?php

namespace BienBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class proprietaireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomProprietaire', TextType::class, array('label' => 'Nom du Propriétaire :',
                'constraints' => array(new NotBlank(), new Length(array('max' => 50)))))
            ->add('prenomProprietaire', TextType::class, array('label' => 'Prénom :',
                'constraints' => array(new NotBlank(), new Length(array('max' => 50)))))
            ->add('telProprietaire', TelType::class, array('label' => 'Téléphone :',
                'constraints' => array(new NotBlank(), new Length(array('max' => 10, 'min' => 10)))))
            ->add('emailProprietaire', EmailType::class, array('label' => 'Adresse mail :',
                'constraints' => array(new NotBlank())))
            ->add('adresse', adresseType::class, array('label' => 'Adresse du propriétaire :'));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BienBundle\Entity\proprietaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bienbundle_proprietaire';
    }


}
