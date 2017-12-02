<?php
namespace Fronten;

use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Router\Http\Segment;
return [
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'fronten' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => '/fronten[/:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'layout/layoutfronten' => __DIR__ . '/../view/layout/layout.phtml',            
        ],
        'template_path_stack' => [
            'fronten' => __DIR__ . '/../view',
        ],
    ],
];