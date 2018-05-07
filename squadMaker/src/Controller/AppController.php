<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler', [
            'enableBeforeRedirect' => false,
        ]);
        $this->loadComponent('Flash');
        $this->loadComponent('Csrf', ['secure' => TRUE]);
        $this->loadComponent('Security', ['blackHoleCallback' => 'forceSSL']);
        $this->loadComponent('Cookie', [
            'secure' => TRUE,
            'httpOnly' => TRUE
        ]);

        $formTemplates = Configure::read('FormTemplates');

        $this->set(compact('formTemplates'));
    }

    /**
     * beforeFilter
     * A CakePHP magic function. In the AppController, this runs before any page is loaded, and does the included operation
     *     for every single page load.
     *
     * @param  Event  $event Data for the action requested
     */
    public function beforeFilter(Event $event) {
        $this->loadModel('Squads');

        $squadCount = $this->Squads->getSquadCount();

        $this->set(compact('squadCount'));
    }

    /**
     * forceSSL
     * This function forces SSL on every page, if an HTTP request is made, this redirects the user to the same page but with SSL
     *
     * @return New header with a location redirect to the same page but https
     */
    public function forceSSL() {
        return $this->redirect('https://' . env('SERVER_NAME') . $this->request->getAttribute('here'));
    }
}
