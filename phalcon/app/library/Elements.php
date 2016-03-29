<?php

use Phalcon\Mvc\User\Component;

/**
 * Elements
 *
 * Helps to build UI elements for the application
 */
class Elements extends Component
{

    private $_navigationMenu = array(
        'navbar-left' => array(
            'index' => array(
                'caption' => 'Home',
                'action' => 'index',
                'icon' => 'fi-home'
            ),
            'vehicles' => array(
                'caption' => 'Vehicles',
                'action' => 'index',
                'icon' => 'fi-shopping-cart'
            ),
            'about' => array(
                'caption' => 'About',
                'action' => 'index',
                'icon' => 'fi-list'
            ),
            'blog' => array(
                'caption' => 'Blog',
                'action' => 'index',
                'icon' => 'fi-social-blogger'
            ),
            'knowledge' => array(
                'caption' => 'Knowledge',
                'action' => 'index',
                'icon' => 'fi-book'
            ),
            'support' => array(
                'caption' => 'Support',
                'action' => 'index',
                'icon' => 'fi-comments'
            ),
            //'search' => array(
            //    'caption' => 'Search',
            //    'action' => 'index',
            //    'icon' => 'fi-magnifying-glass'
            //),
            //'admin' => array(
            //    'caption' => 'Admin',
            //    'action' => 'search',
            //    'icon' => 'fi-star'
            //),
        ),
        'navbar-right' => array(
            'session' => array(
                'caption' => 'Log In/Sign Up',
                'action' => 'index',
                'icon' => 'fi-unlock'
            ),
        )
    );

    private $_tabs = array(
        'Makes' => array(
            'controller' => 'makes',
            'action' => 'index',
            'any' => false
        ),
        'Your Profile' => array(
            'controller' => 'users',
            'action' => 'index',
            'any' => false
        )
    );

    /**
     * Builds user bar
     *
     * @return string
     */
    public function getUser()
    {
        echo '<div class="small-4 columns">';
        echo '<img id="avatar" src = "http://placehold.it/50x50" />';
        echo '</div >';
        echo '<div class="small-8 columns">';
        echo '<h5>Guest</h5>';
        echo '<p>Not logged in</p>';
        echo '</div>';
    }
    /**
     * Builds menu with navigation items
     *
     * @return string
     */
    public function getMenu()
    {

        $auth = $this->session->get('auth');
        if ($auth) {
            $this->_navigationMenu['navbar-left']['session'] = array(
                'caption' => 'Log Out',
                'action' => 'end'
            );
        } else {
            unset($this->_navigationMenu['navbar-left']['user']);
        }

        $controllerName = $this->view->getControllerName();
        foreach ($this->_navigationMenu as $position => $menu) {
            echo '<ul class="vertical menu" data-accordion-menu">';
            foreach ($menu as $controller => $option) {
                if ($controllerName == $controller) {
                    echo '<li class="active">';
                } else {
                    echo '<li>';
                }
                echo $this->tag->linkTo($controller . '/' . $option['action'], '<i class="' . $option['icon'] . '"></i>' . $option['caption']);
                echo '</li>';
            }
            echo '</ul>';
        }

    }

    /**
     * Returns menu tabs
     */
    public function getTabs()
    {
        $controllerName = $this->view->getControllerName();
        $actionName = $this->view->getActionName();
        echo '<ul class="nav nav-tabs">';
        foreach ($this->_tabs as $caption => $option) {
            if ($option['controller'] == $controllerName && ($option['action'] == $actionName || $option['any'])) {
                echo '<li class="active">';
            } else {
                echo '<li>';
            }
            echo $this->tag->linkTo($option['controller'] . '/' . $option['action'], $caption), '</li>';
        }
        echo '</ul>';
    }
}
