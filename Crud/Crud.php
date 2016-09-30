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

use Symfony\Component\EventDispatcher\EventDispatcher;
use vSymfo\Bundle\PanelBundle\Form\Type\ConfirmationFormType;
use Symfony\Component\HttpFoundation\Request;
use vSymfo\Bundle\CoreBundle\Crud\Crud as BaseCrud;
use vSymfo\Core\Crud\Data;
use vSymfo\Core\Crud\DataEvent;

/**
 * @author Rafał Mikołajun <rafal@mikoweb.pl>
 * @package vSymfo Panel Bundle
 * @subpackage Crud
 */
class Crud extends BaseCrud
{
    /**
     * Event is triggering after remove cancel.
     */
    const EVENT_REMOVE_CANCEL = 'remove.cancel';

    /**
     * Event is triggering after remove confirmed.
     */
    const EVENT_REMOVE_CONFIRMED = 'remove.confirmed';

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
        $dispatcher = new EventDispatcher();
        $this->addListeners($dispatcher, $options['events']);
        $this->dispatch($dispatcher, DataEvent::SUBMIT_BEFORE, $data);
        $form->handleRequest($request);
        $this->dispatch($dispatcher, DataEvent::SUBMIT_AFTER, $data);

        if ($form->isValid() && $form->isSubmitted()) {
            if ($form->get('confirm')->isClicked()) {
                $data = parent::destroy($request, $options);
                $this->dispatch($dispatcher, self::EVENT_REMOVE_CONFIRMED, $data);
                return $data;
            } else {
                $data->setResponse($this->redirectToRoute($this->indexRoute()));
                $this->dispatch($dispatcher, self::EVENT_REMOVE_CANCEL, $data);
            }
        }

        return $data;
    }
}
