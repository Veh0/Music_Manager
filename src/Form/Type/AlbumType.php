<?php


namespace App\Form\Type;


use App\Entity\Album\Album;
use App\Entity\Artist\Artist;
use App\Entity\Media\Medium;
use App\Entity\Track\Track;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class)
            ->add('artist', EntityType::class, [
                'class' => Artist::class,
                'choice_label' => function(Artist $artist) {
                    return $artist->getName();
                },
                'placeholder' => 'Choose an artist'
            ])
            ->add('medium', EntityType::class, [
                'class' => Medium::class,
                'choice_label' => function(Medium $medium) {
                return $medium->getType();
                },
                'placeholder' => 'Choose a medium'
            ])
            ->add('tracks', CollectionType::class, [
                'entry_type' => TextType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
            ])
            ->add("duration", TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}