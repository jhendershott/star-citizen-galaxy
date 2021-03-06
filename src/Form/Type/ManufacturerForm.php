<?php

namespace App\Form\Type;

use App\Form\Dto\ManufacturerDto;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ManufacturerForm extends AbstractType
{
    public const MODE_CREATE = 'create';
    public const MODE_EDIT = 'edit';

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
            ])
            ->add('code', TextType::class, [
                'required' => true,
            ])
            ->add('logo', FileType::class, [
                'required' => false,
                'image_path_property' => 'logoPath',
                'image_filter_set' => 'logos',
            ]);
        if ($options['mode'] === self::MODE_EDIT) {
            $builder->add('version', HiddenType::class);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ManufacturerDto::class,
            'allow_extra_fields' => true,
            'mode' => self::MODE_CREATE,
        ]);
    }
}
