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

namespace vSymfo\Bundle\PanelBundle\Controller;

use vSymfo\Bundle\PanelBundle\Crud\Crud;
use vSymfo\Bundle\CoreBundle\Controller\CrudableControllerAbstract;

/**
 * @author Rafał Mikołajun <rafal@mikoweb.pl>
 * @package vSymfo Panel Bundle
 * @subpackage Controller
 */
abstract class Controller extends CrudableControllerAbstract
{
    /**
     * {@inheritdoc}
     */
    public function getCrudClass()
    {
        return Crud::class;
    }
}
