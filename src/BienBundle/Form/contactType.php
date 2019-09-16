<?php

namespace BienBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class contactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array('attr' => array('placeholder' => 'Nom *'),
                'constraints' => array(new NotBlank(), new Length(array('max' => 50)))))
            ->add('sujet', TextType::class, array('attr' => array('placeholder' => 'Sujet *'),
                'constraints' => array(new NotBlank(),new Length(array('max' => 50)))))
            ->add('email', EmailType::class, array('attr' => array('placeholder' => 'E-mail *'),
                'constraints' => array(new NotBlank(), new Email(),)))
            ->add ('telephone', TextType::class, array('attr' => array('placeholder' => 'Téléphone *'),
                'constraints' => array(new NotBlank(), new Length(array('max' => 10, 'min' => 10)))))
            ->add('message', TextareaType::class, array( 'attr' => array('placeholder' => 'Votre Message *','rows' => '6'),
                'constraints' => array(new NotBlank(),)))
            ->add ('Valider', SubmitType::class);
        ;
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'error_bubbling' => true
        ));
    }

    public function getName()
    {
        return 'bienbundle_contact';
    }
}