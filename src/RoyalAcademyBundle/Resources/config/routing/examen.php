<?php

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();

$collection->add('examen_index', new Route(
    '/',
    array('_controller' => 'RoyalAcademyBundle:Examen:index'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('examen_show', new Route(
    '/{idexamen}/show',
    array('_controller' => 'RoyalAcademyBundle:Examen:show'),
    array(),
    array(),
    '',
    array(),
    array('GET')
));

$collection->add('examen_new', new Route(
    '/new',
    array('_controller' => 'RoyalAcademyBundle:Examen:new'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('examen_edit', new Route(
    '/{idexamen}/edit',
    array('_controller' => 'RoyalAcademyBundle:Examen:edit'),
    array(),
    array(),
    '',
    array(),
    array('GET', 'POST')
));

$collection->add('examen_delete', new Route(
    '/{idexamen}/delete',
    array('_controller' => 'RoyalAcademyBundle:Examen:delete'),
    array(),
    array(),
    '',
    array(),
    array('DELETE')
));

return $collection;
