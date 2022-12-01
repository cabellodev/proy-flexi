<?php

function get_rules_product_create(){
    return array(
        array(
                'field' => 'code',
                'label' => 'Código de producto',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'El código del producto es requerido.',
                ),
        ),
        array(
                'field' => 'name',
                'label' => 'Nombre',
                'rules' => 'required|trim',
                'errors' => array(
                        'required' => 'La nombre del producto es requerido.',
                ),
        ),
        array(
                'field' => 'price',
                'label' => 'Precio',
                'rules' => 'required|trim',
                'errors' => array(
                        'required' => 'El precio del producto es requerido.',
                ),
        ),

        array(
                'field' => 'model',
                'label' => 'Modelo',
                'rules' => 'required|trim',
                'errors' => array(
                        'required' => 'El modelo del producto es requerido.',
                ),
        ),

        array(
                'field' => 'supplier',
                'label' => 'Proveedor',
                'rules' => 'required|trim',
                'errors' => array(
                        'required' => 'El proveedor del producto es requerido.',
                ),
        ),

        array(
                'field' => 'category',
                'label' => 'Categoria',
                'rules' => 'required|trim',
                'errors' => array(
                        'required' => 'La categoria del producto es requerida.',
                ),
        ), 

        array(
                'field' => 'imagenPrincipal',
                'label' => 'Imagen Principal',
                'rules' => 'required|trim',
                'errors' => array(
                        'required' => 'La imagen principal es requerida.',
                ),
        ), 
    );
}


function get_rules_product_update(){
        return array(
        array(
                'field' => 'code',
                'label' => 'Código de producto',
                'rules' => 'required|trim',
                'errors' => array(
                'required' => 'El código del producto es requerido.',
                ),
        ),
        array(
                'field' => 'name',
                'label' => 'Nombre',
                'rules' => 'required|trim',
                'errors' => array(
                        'required' => 'La nombre del producto es requerido.',
                ),
        ),
        array(
                'field' => 'price',
                'label' => 'Precio',
                'rules' => 'required|trim',
                'errors' => array(
                        'required' => 'El precio del producto es requerido.',
                ),
        ),
        array(
                'field' => 'model',
                'label' => 'Modelo',
                'rules' => 'required|trim',
                'errors' => array(
                        'required' => 'El modelo del producto es requerido.',
                ),
        ),

        array(
                'field' => 'supplier',
                'label' => 'Proveedor',
                'rules' => 'required|trim',
                'errors' => array(
                        'required' => 'El proveedor del producto es requerido.',
                ),
        ),

        array(
                'field' => 'category',
                'label' => 'Categoria',
                'rules' => 'required|trim',
                'errors' => array(
                        'required' => 'La categoria del producto es requerida.',
                ),
        ),  
        );
}
    
