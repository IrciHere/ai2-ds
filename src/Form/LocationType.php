<?php

namespace App\Form;

use App\Entity\Location;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Range;

class LocationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Enter city name'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a name.',
                        'groups' => ['create', 'edit']
                    ]),
                ],
            ])
            ->add('country', ChoiceType::class, [
                'choices' => [
                    'Poland' => 'PL',
                    'Germany' => 'DE',
                    'France' => 'FR',
                    'Spain' => 'ES',
                    'Italy' => 'IT',
                    'United Kingdom' => 'GB',
                    'United States' => 'US'
                ]
            ])
            ->add('latitude', NumberType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a latitude.',
                        'groups' => ['create', 'edit']
                    ]),
                    new Type([
                        'type' => 'float',
                        'message' => 'Latitude must be a decimal number.',
                        'groups' => ['create', 'edit']
                    ]),
                    new Range([
                        'min' => -90,
                        'max' => 90,
                        'minMessage' => 'Latitude must be between -90 and 90.',
                        'maxMessage' => 'Latitude must be between -90 and 90.',
                        'groups' => ['create', 'edit']
                    ]),
                ]
            ])
            ->add('longitude', NumberType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a longitude.',
                        'groups' => ['create', 'edit']
                    ]),
                    new Type([
                        'type' => 'float',
                        'message' => 'Longitude must be a decimal number.',
                        'groups' => ['create', 'edit']
                    ]),
                    new Range([
                        'min' => -180,
                        'max' => 180,
                        'minMessage' => 'Longitude must be between -180 and 180.',
                        'maxMessage' => 'Longitude must be between -180 and 180.',
                        'groups' => ['create', 'edit']
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Location::class,
        ]);
    }
}
