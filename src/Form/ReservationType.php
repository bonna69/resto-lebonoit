<?php
// src/Form/ReservationType.php
namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Nom'])
            ->add('firstname', TextType::class, ['label' => 'Prénom'])
            ->add('email', EmailType::class, ['label' => 'Email'])
            ->add('phone', TelType::class, ['label' => 'Téléphone'])
            ->add('date', DateType::class, [
                'label' => 'Date',
                'widget' => 'single_text',
            ])
            ->add('time', ChoiceType::class, [
                'label' => 'Heure',
                'choices' => $this->getTimeChoices(),
                'placeholder' => 'Choisissez une heure', // Optionnel pour une meilleure UX
            ])
            ->add('number_of_persons', ChoiceType::class, [
                'label' => 'Nombre de personnes',
                'choices' => array_combine(range(1, 9), range(1, 9)),
                'expanded' => false,
                'multiple' => false,
            ])
            ->add('special_requests', TextType::class, [
                'label' => 'Demandes spéciales',
                'required' => false,
            ])
            ->add('submit', SubmitType::class, ['label' => 'Réserver']);
    }

    private function getTimeChoices(): array
    {
        $times = [];
        for ($hour = 12; $hour <= 21; $hour++) {
            for ($minute = 0; $minute <= 45; $minute += 15) {
                $formattedTime = sprintf('%02d:%02d', $hour, $minute);
                $times[$formattedTime] = $formattedTime;
            }
        }
        return $times;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}