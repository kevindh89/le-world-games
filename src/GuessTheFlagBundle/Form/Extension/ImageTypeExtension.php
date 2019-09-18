<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\PropertyAccess\PropertyAccess;

class ImageTypeExtension extends AbstractTypeExtension
{
    public function getExtendedType(): string
    {
        return TextType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefined(['image_property']);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        if (!isset($options['image_property'])) {
            return;
        }

        $data = $form->getParent()->getData();

        $imageUrl = null;
        if (null !== $data) {
            $accessor = PropertyAccess::createPropertyAccessor();
            $imageUrl = $accessor->getValue($data, $options['image_property']);
        }

        $view->vars['image_url'] = $imageUrl;
    }
}
