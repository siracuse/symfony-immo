<?php

namespace BienBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class adresseType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bpAdresse', IntegerType::class, array('label' => 'Boîte Postal : ',
                'constraints' => array(new NotBlank(), new Length(array('max' => 9)))))
            ->add('rueAdresse', TextType :: class, array('label' => 'Rue / Chemin :',
                'constraints' => array(new NotBlank(), new Length(array('max' => 50)))))
            ->add('nomVille', ChoiceType::class, array(
                'label' => 'Ville :',
                'choices' => array(
                    'Bras-Panon' => 'Bras-Panon',
                    'Ciloas' => 'Ciloas',
                    'Entre-Deux' => 'Entre-Deux',
                    'L\'Étang-Salé' => 'L\'Étang-Salé',
                    'La Plaine-des-Palmistes' => 'La Plaine-des-Palmistes',
                    'La Possession' => 'La Possession',
                    'Le Port' => 'Le Port',
                    'Le Tampon' => 'Le Tampon',
                    'Les Avirons' => 'Les Avirons',
                    'Les Trois-Bassins' => 'Les Trois-Bassins',
                    'Petite-Île' => 'Petite-Île',
                    'Saint-André' => 'Saint-André',
                    'Saint-Benoît' => 'Saint-Benoît',
                    'Saint-Denis' => 'Saint-Denis',
                    'Saint-Joseph' => 'Saint-Joseph',
                    'Saint-Leu' => 'Saint-Leu',
                    'Saint-Louis' => 'Saint-Louis',
                    'Saint-Paul' => 'Saint-Paul',
                    'Saint-Philippe' => 'Saint-Philippe',
                    'Saint-Pierre' => 'Saint-Pierre',
                    'Sainte-Marie' => 'Sainte-Marie',
                    'Sainte-Rose' => 'Sainte-Rose',
                    'Sainte-Suzanne' => 'Sainte-Suzanne',
                    'Salazie' => 'Salazie',
                ),
                'constraints' => array(new NotBlank(), new Length(array('max' => 50)))))
            ->add('cpVille', IntegerType::class, array ('label' => 'Code Postal : ',
                'constraints' => array(new NotBlank(), new Length(array('min' => 5, 'max' => 5)))))
            ->add('zoneGeo', EntityType::class,
                array('label' => 'Zone : ',
                    'class' => 'BienBundle\Entity\zoneGeo',
                        'choice_label' => 'nomZone'
            ))
            ->add('Valider', SubmitType::class, array('attr' => array('class' => 'btn btn-primary btn-block')))
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BienBundle\Entity\adresse'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bienbundle_adresse';
    }


}
