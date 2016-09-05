<?php

/*
 * This file is part of the vSymfo package.
 *
 * website: www.mikoweb.pl
 * (c) Rafał Mikołajun <rafal@mikoweb.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace vSymfo\Bundle\PanelBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Rafał Mikołajun <rafal@mikoweb.pl>
 * @package vSymfo Panel Bundle
 * @subpackage Form
 */
class ConfirmationFormType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('confirm', SubmitType::class, [
                'label' => $options['label_confirm'],
            ])
            ->add('cancel', SubmitType::class, [
                'label' => $options['label_cancel'],
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'cascade_validation' => true,
            'label_confirm' => 'global.confirm',
            'label_cancel' => 'global.cancel',
        ]);

        $resolver->setAllowedTypes('label_confirm', 'string');
        $resolver->setAllowedTypes('label_cancel', 'string');
    }
}
