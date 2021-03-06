<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Form;

use GuessTheFlagBundle\Entity\Flag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FlagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        $builder
            ->add('country', TextType::class)
            ->add('image', TextType::class, ['image_property' => 'image'])
            ->add('continent', ContinentType::class)
            ->add('isEu', CheckboxType::class, ['required' => false, 'label' => 'Is in European Union?'])
            ->add('colors', FlagColorsType::class)
            ->add('cities', TextType::class, ['required' => false])
            ->add('photoFile', FileType::class, ['mapped' => false, 'required' => false])
        ;

        $builder->get('cities')
            ->addModelTransformer(new CallbackTransformer(
                function ($tagsArray) {
                    return implode(', ', $tagsArray);
                },
                function ($tagsString) {
                    return $tagsString ? explode(', ', $tagsString) : [];
                }
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Flag::class,
            'validation_groups' => function (FormInterface $form) {
                /** @var Flag $flag */
                $flag = $form->getData();

                if ($flag->getContinent() === 'europe') {
                    return ['Default'];
                }

                return ['Default', 'non-eu'];
            },
        ]);
    }
}
