<?php

namespace BienBundle\Form;

use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class bienType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreBien', TextType::class, array('label' => 'Titre du bien : ',
                'constraints' => array(new NotBlank(), new Length(array('max' => 50)))))
            ->add('surfaceBien', IntegerType::class, array('label' => 'Surface du bien (m²) : ',
                'constraints' => array(new NotBlank(), new Length(array('max' => 9)))))
            ->add('nbPieceBien', IntegerType::class, array('label' => 'Nombre pièce(s) : ',
                'constraints' => array(new NotBlank(), new Length(array('max' => 9)))))
            ->add('nbChambreBien', IntegerType::class, array('label' => 'Nombre chambre(s) : ',
                'constraints' => array(new NotBlank(), new Length(array('max' => 9)))))
            ->add('nbSalleDeBainBien', IntegerType::class, array('label' => 'Nombre salle(s) d\'eau : ',
                'constraints' => array(new NotBlank(), new Length(array('max' => 9)))))
            ->add('descripBien', CKEditorType::class, array('config_name' => 'custom_config','label' => 'Description :',
                'constraints' => array(new NotBlank())))
            ->add('adresse', adresseType::class, array('label' => 'Adresse du bien :'))
            ->add('prixBien', IntegerType::class, array('label' => 'Prix (€) : ',
                'constraints' => array(new NotBlank(), new Length(array('max' => 9)))))
            ->add('typeVenteBien', ChoiceType::class,
                array('choices' => array(
                    'Vente' => 'À Vendre',
                    'Location' => 'À Louer'
                )))
            ->add('typeBien', EntityType::class,
                array('class' => 'BienBundle\Entity\typeBien',
                    'choice_label' => 'nomTypeBien'
                ))
            ->add('proprietaire', proprietaireType::class, array('label' => 'Information sur le propriétaire :'))
            ->add('agents', EntityType::class,
                array('label' => 'Agents responsables: ',
                    'class' => 'BienBundle\Entity\agent',
                    'choice_label' => 'nomAgent',
                    'expanded' => false,
                    'multiple' => true
                ))
            ->add('agences', EntityType::class,
                array('label' => 'Agences responsables: ',
                    'class' => 'BienBundle\Entity\agence',
                    'choice_label' => 'nomAgence',
                    'expanded' => false,
                    'multiple' => true
                ))
            ->add('detailsBiens', EntityType::class,
                array('label' => 'Les options du bien :',
                    'class' => 'BienBundle\Entity\detailsBien',
                    'choice_label' => 'nomDetails',
                    'expanded' => true,
                    'multiple' => true
                ))
            ->add('photoBien', FileType::class, array('label' => 'Photo du bien : ', 'data_class' => null, 'attr' => array('name' => 'input-file-preview'),
                'constraints' => array(new File (array('maxSize' => "500k", 'maxSizeMessage' => "Votre fichier est trop lourd !! 500 ko maximum",
                    'mimeTypes' => array('image/png', 'image/jpeg')

                )))))
            ->add ('statutBien', ChoiceType::class, array (
                                                                    'choices' => array(
                                                                                    'Oui' => 'Activé',
                                                                                     'Non' => 'Désactivé',
                                                                                    ) ,
                                                                    'expanded' => true,
                    'multiple' => false,
                    'label' => 'Publier l\'annonce :', 'constraints' => array(new NotBlank()))
            )
            ->add('Valider', SubmitType::class, array('attr' => array('class' => 'btn btn-primary btn-block')))
            ;

    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BienBundle\Entity\bien'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bienbundle_bien';
    }


}
