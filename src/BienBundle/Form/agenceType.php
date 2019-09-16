<?php

namespace BienBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class agenceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomAgence', TextType::class, array('label' => 'Nom de l\'agence : ',
                'constraints' => array(new NotBlank(), new Length(array('max' => 50)))))
            ->add('telAgence', TextType::class, array('label' => 'Téléphone : ',
                'constraints' => array(new NotBlank(), new Length(array('max' => 10, 'min' => 10)))))
            ->add('emailAgence', EmailType::class, array('label' => 'Adresse mail : ',
                'constraints' => array(new NotBlank())))
            ->add('agents', EntityType::class,
                array('label' => 'Les agents qui seront affectés à l\'agence : ',
                    'class' => 'BienBundle\Entity\agent',
                    'choice_label' => 'nomAgent',
                    'expanded' => false,
                    'multiple' => true,
                    'required' => false,
                    'attr' => array('size' => '6')
                ))
            ->add('descripAgence', CKEditorType::class, array('config_name' => 'custom_config', 'label' => 'Description :','attr' => array('rows' => '6'),
                'constraints' => array(new NotBlank())))
            ->add('photoAgence', FileType::class, array('label' => 'Photo de l\'agence : ','data_class' => null, 'attr' => array('name' => 'input-file-preview'),
                'constraints' => array(new File (array('maxSize' => "300k", 'maxSizeMessage' => "Votre fichier est trop lourd !! 300ko maximum",
                    'mimeTypes' => array('image/png', 'image/jpeg'))))))
            ->add('adresse', adresseType::class)
            ->add ('agencePrincipale', ChoiceType::class, array (
                    'choices' => array(
                        'Oui' => 'oui',
                        'Non' => 'non',
                    ) ,
                    'expanded' => true,
                    'multiple' => false,
                    'label' => 'Agence Principale :', 'constraints' => array(new NotBlank()))
            )
        ;

    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BienBundle\Entity\agence'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bienbundle_agence';
    }


}
