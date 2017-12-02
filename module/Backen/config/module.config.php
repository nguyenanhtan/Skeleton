<?php
namespace Backen;

// use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Segment;
return [
    // 'controllers' => [
    //     'factories' => [
    //         Controller\BackenController::class => InvokableFactory::class,
    //     ],
    // ],
    'router' => [
        'routes' => [
            'backen' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/backen[/:action[/:id]]',
                    'constraints' => [                        
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\BackenController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'ajax' => [//routing for a controller
                'type'    => Segment::class,
                'options' => [
                    'route' => '/ajax[/:action[/:id]]',
                    'constraints' => [                       
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AjaxController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'blog' => [//routing for a controller
                'type'    => Segment::class,
                'options' => [
                    'route' => '/blog[/:action[/:id]]',
                    'constraints' => [                       
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\BlogController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'layout/layoutbacken'           => __DIR__ . '/../view/layout/layout.phtml',           
        ],
        'template_path_stack' => [
            'backen' => __DIR__ . '/../view',
        ],
    ],
    
];