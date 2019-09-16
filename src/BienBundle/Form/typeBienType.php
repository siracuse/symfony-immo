<?php

namespace BienBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class typeBienType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomTypeBien', TextType::class, array('label' => 'Nom du type de bien :',
                'constraints' => array(new NotBlank(), new Length(array('max' => 50)),),))
            ->add('descriptionType', TextareaType::class, array('label' => 'Description du type de bien :',
                'attr' => array('rows' => '6'),
                'constraints' => array(new NotBlank())))
            ->add ('Valider', SubmitType::class, array('attr' => array('class' => 'btn btn-primary btn-block')));
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BienBundle\Entity\typeBien'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bienbundle_typebien';
    }
}