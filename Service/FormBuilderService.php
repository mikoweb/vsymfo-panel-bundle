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

namespace vSymfo\Bundle\PanelBundle\Service;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @author Rafał Mikołajun <rafal@mikoweb.pl>
 * @package vSymfo Panel Bundle
 * @subpackage Service
 */
class FormBuilderService
{
    /**
     * @param FormBuilderInterface $builder
     */
    public function addSaveButton(FormBuilderInterface $builder)
    {
        $builder->add('save', SubmitType::class, [
            'label' => 'global.buttons.save',
            'attr' => [
                'class' => 'btn-success',
                'icon' => 'fa fa-floppy-o',
            ]
        ]);
    }
}
