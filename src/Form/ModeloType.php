<?php

namespace App\Form;

use App\Entity\Modelo;
use App\Entity\Piloto;
use Laminas\Code\Generator\DocBlock\Tag\AbstractTypeableTag;
use PhpParser\Parser\Multiple;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class ModeloType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('temporada')
            ->add('cilindrada')
            ->add('turbo')
            ->add('peso')
            ->add('imagen')
            ->add('pilotos', EntityType::class,[
                'class' => Piloto::class, 
                'choice_label' => 'nombre',
                'multiple' => true,
                'expanded' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Modelo::class,
        ]);
    }
}
