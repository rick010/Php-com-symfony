<?php

namespace App\Form;

use App\Entity\Agencia;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgenciaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroAgencia')
            ->add('endereco')
            ->add('numeroEndereco')
            ->add('cep')
            ->add('bairro')
            ->add('cidade')
            ->add('estado')
            ->add('dataCriacao')
            ->add('gerente')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Agencia::class,
        ]);
    }
}
