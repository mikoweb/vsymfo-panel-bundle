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

use Symfony\Component\HttpFoundation\Response;
use vSymfo\Core\Controller as CoreController;

/**
 * @author Rafał Mikołajun <rafal@mikoweb.pl>
 * @package vSymfo Panel Bundle
 * @subpackage Controller
 */
class ExceptionController extends CoreController
{
    /**
     * @return Response
     */
    public function loginBlockedAction()
    {
        $params = $this->getParameter('ccdn_user_security.login_shield.block_pages');

        return $this->renderDocument('TwigBundle:Exception:login-blocked.html.twig', [
            'max_attempts' => $params['after_attempts'],
            'block_duration' => $params['duration_in_minutes'],
        ]);
    }
}