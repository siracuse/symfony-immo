<?php

namespace BienBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\File;

class agentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomAgent', TextType::class, array('label' => 'Nom de l\'agent : ',
                'constraints' => array(new NotBlank(), new Length(array('max' => 50)))))
            ->add('prenomAgent',TextType::class, array('label' => 'Prénom : ',
                'constraints' => array(new NotBlank(), new Length(array('max' => 50)))))
            ->add('telAgent',TextType::class, array('label' => 'Téléphone : ',
                'constraints' => array(new NotBlank(), new Length(array('max' => 10, 'min' => 10)))))
            ->add('emailAgent', EmailType::class, array('label' => 'Adresse mail : ',
                'constraints' => array(new NotBlank())))
            ->add('adresse', adresseType::class)
            ->add('photoAgent', FileType::class, array('label' => 'Photo de profil : ','data_class' => null, 'attr' => array('name' => 'input-file-preview'),
                'constraints' => array(new File (array('maxSize' => "300k", 'maxSizeMessage' => "Votre fichier est trop lourd !! 300ko maximum",
                                        'mimeTypes' => array('image/png', 'image/jpeg')
                )))))
        ;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BienBundle\Entity\agent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bienbundle_agent';
    }


}
