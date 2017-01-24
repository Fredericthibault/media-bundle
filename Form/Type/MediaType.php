<?php
/**
 * Created by PhpStorm.
 * User: pmdc
 * Date: 24/01/17
 * Time: 11:56 AM
 */

namespace Viweb\MediaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Viweb\MediaBundle\Entity\Media;

class MediaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('path', FileType::class, [
                'label' => 'Fichier Media',
                'data_class' => null
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Media::class,
        ));
    }
}