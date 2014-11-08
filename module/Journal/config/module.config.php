<?php
namespace Journal;

return array(
    'controllers' => array(
        'invokables' => array(
            'Journal\Controller\Entity' => 'Journal\Controller\EntityController',
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
                    'route'    => '/journal[/:action][/:grade_id][/:subject_id][/:date]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'grade_id'     => '[0-9]+',
                        'subject_id'     => '[0-9]+',
                        'time'     => '[0-9_-]+',
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
                    'route'    => '/unit[/:id][/:action]',
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
    'doctrine' => array(
        'driver' => array(
            __NAMESPACE__ . '_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                )
            )
        )
    )
);
