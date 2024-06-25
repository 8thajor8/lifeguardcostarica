<?php

namespace Controllers;
use MVC\Router;
use Model\Clinica;
use Model\Servicio;
use Model\Testimonial;


class PaginasController{

    public static function index(Router $router){

        $clinicas = Clinica::get(3);
        $servicios = Servicio::all();
        $testimonials = Testimonial::all();
        $inicio = true;

        

        $router->render('pagina/index', ['inicio' => $inicio, 'clinicas' => $clinicas, 'servicios' => $servicios, 'testimonials' => $testimonials]);

    }

    public static function clinicas(Router $router){
        
        $clinicas = Clinica::all();
        
        $router->render('pagina/clinicas', ['clinicas' => $clinicas]);

    }

    public static function configuracion(Router $router){
        

        $router->render('admin/configuracion');

    }

    

}