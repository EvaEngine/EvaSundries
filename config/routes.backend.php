<?php

return array(

    '/admin/block/:action' => array(
        'module' => 'EvaSundries',
        'controller' => 'Admin\Block',
        'action' => 1
    ),
    '/admin/block/visibility/(\d+)' => array(
        'module' => 'EvaSundries',
        'controller' => 'Admin\Block',
        'action' => 'visibility',
        'id' => 1
    ),
    '/admin/block/edit/(\d+)' => array(
        'module' => 'EvaSundries',
        'controller' => 'Admin\Block',
        'action' => 'edit',
        'id' => 1
    ),
    '/admin/keyword/:action' => array(
        'module' => 'EvaSundries',
        'controller' => 'Admin\Keyword',
        'action' => 1
    ),
    '/admin/option/:action' => array(
        'module' => 'EvaSundries',
        'controller' => 'Admin\Option',
        'action' => 1,
    ),
    '/admin/option/edit/(\d+)' => array(
        'module' => 'EvaSundries',
        'controller' => 'Admin\Option',
        'action' => 'edit',
        'id' => 1,
    ),
    '/admin/cdn' => array(
        'module' => 'EvaSundries',
        'controller' => 'Admin\Cdn',
        'action' => 'index',
    ),
    '/admin/cdn/update' => array(
        'module' => 'EvaSundries',
        'controller' => 'Admin\Cdn',
        'action' => 'update',
    ),
);