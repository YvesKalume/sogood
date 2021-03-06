<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Song;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SongType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',null,[
            "label"=>"Titre"
            ])
            ->add('singer',null,[
                "label"=>"Chanteur"
            ])
            ->add('songFile',FileType::class,[
                "required"=>false,
                "label"=>"Fichier"
            ])
            ->add('imageFile',FileType::class,[
                "required" => false,
                "label" => 'Image'
            ])

            ->add('category',EntityType::class,[
                'class'=>Category::class,
                'choice_label'=> 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Song::class,
        ]);
    }
}
