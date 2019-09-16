<?php

namespace BienBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class couleurType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomCouleur',ChoiceType::class, array (
                    'choices' => array(
                        'bleu' => 'blue',
                        'bleu-clair' => 'blue-light',
                        'marron' => 'brown',
                        'par-defaut' => 'default',
                        'vert-clair' => 'green-light',
                        'vert-clair-clair' => 'green-light-2',
                        'olive' => 'olive',
                        'orange' => 'orange',
                        'violet' => 'purple',
                        'rouge' => 'red',
                        'jaune' => 'yellow',
                        'jaune-clair' => 'yellow-light',
                    ) ,
                    'expanded' => true, 'multiple' => false, 'label' => ' ', 'constraints' => array(new NotBlank())))
            ->add('Valider', SubmitType::class, array('attr' => array('class' => 'btn btn-primary btn-block')))
        ;




    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BienBundle\Entity\couleur'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bienbundle_couleur';
    }


}
