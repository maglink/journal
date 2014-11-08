<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Admin\Controller\Mark' => 'Admin\Controller\MarkController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'admin' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                    ),
                ),
                'child_routes' => array(
                    'mark' => array(
                        'type'    => 'segment',
                        'options' => array(
                            'route'    => '/mark/:unit_id/:lesson_id[/:action]',
                            'constraints' => array(
                                'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'unit_id'     => '[0-9]+',
                                'lesson_id'     => '[0-9]+',
                            ),
                            'defaults' => array(
                                'controller' => 'Admin\Controller\Mark',
                                'action'     => 'edit',
                            ),
                        ),
                    ),
                ),                
                
            ),    
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'admin' => __DIR__ . '/../view',
        ),
    ),
);
