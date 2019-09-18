<?php

declare(strict_types=1);

namespace GuessTheFlagBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\DataMapperInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

class FlagColorsType extends AbstractType implements DataMapperInterface
{
    private $colors = ['red', 'blue', 'orange', 'yellow', 'black', 'white', 'green'];

    public function buildForm(FormBuilderInterface $builder, array $options = [])
    {
        foreach ($this->colors as $color) {
            $builder->add($color, CheckboxType::class, ['required' => false]);
        }

        $builder->setDataMapper($this);
    }

    public function mapDataToForms($viewData, $forms)
    {
        if ($viewData === null) {
            return;
        }

        if (gettype($viewData) !== 'array') {
            throw new UnexpectedTypeException($viewData, 'array');
        }

        $forms = iterator_to_array($forms);

        foreach ($this->colors as $color) {
            $forms[$color]->setData((bool) in_array($color, $viewData, true));
        }
    }

    public function mapFormsToData($forms, &$viewData)
    {
        $forms = iterator_to_array($forms);

        $viewData = [];

        foreach ($forms as $color => $colorForm) {
            if ((bool) $colorForm->getData()) {
                $viewData[] = $color;
            }
        }
    }
}
