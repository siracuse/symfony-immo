<?php
namespace BienBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class bienSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('typeVenteBien', ChoiceType::class,
                array('choices' => array('-- Achat / Location --' => null, 'Achat' =>'À Vendre', 'À Louer' => 'À Louer')))

            ->add('typeBien', EntityType::class,
                array('class' => 'BienBundle\Entity\typeBien',
                    'choice_label' => 'nomTypeBien',
                    'placeholder' => '-- Type de bien --',
                    'required' => false
                ))
            ->add('zoneGeo', EntityType::class,
                array('class' => 'BienBundle\Entity\zoneGeo',
                    'choice_label' => 'nomZone',
                    'placeholder' => '-- Zone Géo --',
                    'required' => false
                ))
            ->add('nbPiece', ChoiceType::class,
                array('choices' => array('-- Pièces --' => null, '1' =>1, '2' => 2, '3' => 3, '4' => 4, '5' => 5)))
            ->add ('nbChambre', ChoiceType::class,
                array('choices' => array('-- Chambres --' => null, '1' =>1, '2' => 2, '3' => 3, '4' => 4, '5' => 5)))
            ->add ('nbSalleDeBain', ChoiceType::class,
                array('choices' => array('-- Salles d\'eau --' => null, '1' =>1, '2' => 2, '3' => 3, '4' => 4, '5' => 5)))
            ->add('surfaceBienMax', ChoiceType::class,
                array('choices' =>
                    array('-- Surface Maximum --' => null,
                        '50' => 50,
                        '100' => 100,
                        '200' => 200,
                        '300' => 300,
                        '400' => 400,
                        '> 500' => 9999,
                    )))
            ->add('prixMax', RangeType::class)
            ->add('Rechercher', submitType::class, array('attr' => array('class' => 'search-button')))
            ;
    }

    public function getName()
    {
        return 'bien_search';
    }
}
