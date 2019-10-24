<?php


namespace App\Form\Type;


use App\Entity\Album\Album;
use App\Entity\Artist\Artist;
use App\Entity\Track\Track;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrackType extends AbstractType
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
            ->add('album', EntityType::class, [
                'class' => Album::class,
                'choice_label' => function(Album $album) {
                    return $album->getTitle();
                },
                'placeholder' => 'Choose an album'
            ])
            ->add('duration', TextType::class);
            /*->add('media', EntityType::class, [
                'class' => Album::class,
                'choice_label' => function(Album $album) {
                    return $album->getMedia();
                },
                'placeholder' => 'Choose a'
            ]);*/
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Track::class,
        ]);
    }
}