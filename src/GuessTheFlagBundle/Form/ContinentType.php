<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContinentType extends AbstractType
{
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['choice_count'] = count($options['choices']);
    }

    public function configureOptions(OptionsResolver $optionsResolver)
    {
        $optionsResolver->setDefaults([
            'choices' => [
                'Europe' => 'europe',
                'Asia' => 'asia',
                'Africa' => 'africa',
                'North-America' => 'north-america',
                'South-America' => 'south-america',
                'Australia' => 'australia',
            ],
            'choices_as_values' => true,
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }
}
