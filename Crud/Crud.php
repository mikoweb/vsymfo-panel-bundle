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

namespace vSymfo\Bundle\PanelBundle\Crud;

use vSymfo\Bundle\PanelBundle\Form\Type\ConfirmationFormType;
use Symfony\Component\HttpFoundation\Request;
use vSymfo\Bundle\CoreBundle\Crud\Crud as BaseCrud;
use vSymfo\Core\Crud\Data;

/**
 * @author Rafał Mikołajun <rafal@mikoweb.pl>
 * @package vSymfo Panel Bundle
 * @subpackage Crud
 */
class Crud extends BaseCrud
{
    /**
     * {@inheritdoc}
     */
    public function destroy(Request $request, array $options = [])
    {
        $options = $this->commonOptionsResolver()->resolve($options);
        $data = new Data();
        $entity = $this->getManager()->findEntity($request);
        $data->setEntity($entity);
        $form = $this->container->get('form.factory')
            ->createBuilder(ConfirmationFormType::class, null, [
                'action' => $this->generateUrl($this->destroyRoute(), $this->routeParameters($data, $options))
            ])
            ->getForm()
        ;
        $data->setForm($form);
        $form->handleRequest($request);

        if ($form->isValid() && $form->isSubmitted()) {
            if ($form->get('confirm')->isClicked()) {
                return parent::destroy($request, $options);
            } else {
                $data->setResponse($this->redirectToRoute($this->indexRoute()));
            }
        }

        return $data;
    }
}
