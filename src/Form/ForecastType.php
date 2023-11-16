<?php

namespace App\Form;

use App\Entity\Forecast;
use App\Entity\ForecastSummary;
use App\Entity\Location;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;
use Symfony\Component\Validator\Constraints\Type;


class ForecastType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('timestamp', DateTimeType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a timestamp.',
                        'groups' => ['create', 'edit']
                    ]),
                    new Type([
                        'type' => '\DateTimeInterface',
                        'message' => 'Insert a correct timestamp format.',
                        'groups' => ['create', 'edit']
                    ]),
                    new GreaterThan([
                        'value' => '2000-01-01',
                        'message' => 'Timestamp must not be from before year 2000.',
                        'groups' => ['create', 'edit']
                    ]),
                ]
            ])
            ->add('type',  ChoiceType::class, [
                'choices' => [
                    'Hourly' => 1,
                    'Daily' => 2
                ],
            ])
            ->add('temperature', IntegerType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a temperature.',
                        'groups' => ['create', 'edit']
                    ]),
                    new Range([
                        'min' => -100,
                        'max' => 100,
                        'minMessage' => 'Temperature must be between -100 and 100.',
                        'maxMessage' => 'Temperature must be between -100 and 100.',
                        'groups' => ['create', 'edit']
                    ]),
                ],
            ])
            ->add('windSpeed', NumberType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a wind speed.',
                        'groups' => ['create', 'edit']
                    ]),
                    new Type([
                        'type' => 'float',
                        'message' => 'Wind speed must be a decimal number.',
                        'groups' => ['create', 'edit']
                    ]),
                    new Range([
                        'min' => 0,
                        'max' => 500,
                        'minMessage' => 'Wind speed must be between 0 and 500.',
                        'maxMessage' => 'Wind speed must be between 0 and 500.',
                        'groups' => ['create', 'edit']
                    ]),
                ],
            ])
            ->add('precipitation', IntegerType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a precipitation.',
                        'groups' => ['create', 'edit']
                    ]),
                    new Range([
                        'min' => 0,
                        'max' => 100,
                        'minMessage' => 'Precipitation must be between 0 and 100.',
                        'maxMessage' => 'Precipitation must be between 0 and 100.',
                        'groups' => ['create', 'edit']
                    ]),
                ],
            ])
            ->add('location', EntityType::class, [
                'class' => Location::class,
                'choice_label' => 'name'
            ])
            ->add('forecastSummary', EntityType::class, [
                'class' => ForecastSummary::class,
                'choice_label' => 'name'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Forecast::class,
        ]);
    }
}
