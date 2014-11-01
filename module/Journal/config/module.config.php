<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Journal\Controller\Table' => 'Journal\Controller\TableController',
            'Journal\Controller\Journal' => 'Journal\Controller\JournalController',
            'Journal\Controller\Grade' => 'Journal\Controller\GradeController',
            'Journal\Controller\Unit' => 'Journal\Controller\UnitController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Journal\Controller\Grade',
                        'action'     => 'index',
                    ),
                ),
            ),
            'journal' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/journal[/:action][/:grade_id][/:subject_id][/:time]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'grade_id'     => '[0-9]+',
                        'subject_id'     => '[0-9]+',
                        'time'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Journal\Controller\Journal',
                        'action'     => 'index',
                    ),
                ),
            ),
            'grade' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/grade[/:id][/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Journal\Controller\Grade',
                        'action'     => 'index',
                    ),
                ),
            ),
            'unit' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/unit[/:action][/:id][/:subject_id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Journal\Controller\Unit',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'journal' => __DIR__ . '/../view',
        ),
    ),
);
