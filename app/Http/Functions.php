<?php
// Key Value From Json
function kvfl($json, $key)
{
    if ($json == null):
        return null;
    else:
        $json = $json;
        $json = json_decode($json, true);
        if (array_key_exists($key, $json)):
            return $json[$key];
            else:
            return null;
        endif;
    endif;
}

function getModulesArray()
{
    $a = [
            '0' => 'Products',
            '1' => 'Blog',
            '2' => 'Comida'
    ];

    return $a;
}

function getRoleUserArray($mode,$id)
{
    $roles = ['0' => 'Usuario', '1' => 'Administrador'];
    if(!is_null($mode)):
        return $roles;
    else:
        return $roles[$id];
    endif;
}

function getStatusUserArray($mode,$id)
{
    $status = ['0' => 'Registrado', '1' => 'Verificado', '100' => 'Baneado'];
    if(!is_null($mode)):
        return $status;
    else:
        return $status[$id];
    endif;
}

function user_permission()
{
    $p = [
        'dashboard' => [
            'icon' => '<i class="fas fa-home"></i>',
            'title' => 'Modulo Dashboard',
            'keys' => [
                'dashboard' => 'Puede ver el dashboard',
                'dashboard_small_stats' => 'Puede ver el dashboard_small_stats',
                'dashboard_sell_today' => 'Puede ver el dashboard_sell_today',
            ]
        ],
            'products' => [
                'icon' => '<i class="fas fa-boxes"></i>',
                'title' => 'Modulo Productos',
                'keys' => [
                    'products' => 'Puede ver el listado de productos',
                    'product_add' => 'Puede agregas nuevos productos',
                    'product_edit' => 'Puede editar productos',
                    'product_search' => 'Puede buscar productos',
                    'product_add_gallery' => 'Puede colocar imagenes a un productos',
                    'product_add_delete' => 'Puede eliminar imagenes a un productos',
                    'product_delete' => 'Puede eliminar un productos',
                    'product_inventory' => 'Puede administrar el inventario de un producto',
                ]
            ],
        'categories' => [
            'icon' => '<i class="fas fa-folder-open"></i>',
            'title' => 'Modulo Categorias',
            'keys' => [
                'categories' => 'Puede ver el listado de categorias',
                'category_add' => 'Puede crear categorias',
                'category_edit' => 'Puede editar categorias',
                'category_delete' => 'Puede eliminar categorias',
            ]
        ],

        'users' => [
            'icon' => '<i class="fas fa-user-friends"></i>',
            'title' => 'Modulo Usuarios',
            'keys' => [
                'user_list' => 'Puede ver el listado de usuarios',
                'user_edit' => 'Puede editar usuarios',
                'user_banned' => 'Puede banear un usuarios',
                'user_permissions' => 'Puede dar permisos de usuarios',
            ]
        ],
        'orders' => [
            'icon' => '<i class="fas fa-clipboard-list"></i>',
            'title' => 'Modulo de Ordenes',
            'keys' => [
                'orders_list' => 'Puede ver el listado de ordenes',
            ]
        ],
        'sliders' => [
            'icon' => '<i class="fas fa-images"></i>',
            'title' => 'Modulo de Sliders',
            'keys' => [
                'sliders' => 'Puede ver el listado de sliders',
                'slider_add' => 'Puede agregar sliders',
                'slider_edit' => 'Puede editar sliders',
                'slider_deleted' => 'Puede eliminar sliders',
            ]
        ],
        'settings' => [
            'icon' => '<i class="fas fa-cogs"></i>',
            'title' => 'Modulo de Configuraciones',
            'keys' => [
                'settings' => 'Puede modificar la configuración',
            ]
        ],

        'coverage' => [
            'icon' => '<i class="fas fa-shipping-fast"></i>',
            'title' => 'Cobertura de Envios',
            'keys' => [
                'coverage_list' => 'Puede ver la lista de cobertura de envios',
                'coverage_add' => 'Puede crear zonas de envio',
                'coverage_edit' => 'Puede editar zonas de envio',
                'coverage_delete' => 'Puede eliminar zonas de envio',
            ]
        ],
    ];
    return $p;
}

function getUserYears(){
    $ya = date('Y');
    $ym = $ya - 18;
    $yo = $ym - 62;
    return [$ym,$yo];
}

function getMonths($mode, $key)
{
    $m = [
        '1'=> 'Enero',
        '2'=> 'Febrero',
        '3'=> 'Marzo',
        '4'=> 'Abril',
        '5'=> 'Mayo',
        '6'=> 'Junio',
        '7'=> 'Julio',
        '8'=> 'Agosto',
        '9'=> 'Septiembre',
        '10'=> 'Octubre',
        '11'=> 'Noviembre',
        '12'=> 'Diciembre',
    ];
    if ($mode == 'list'){
        return $m;
    }else{
        return [$key];
    }
}


function getShippingMethod($method = null)
{
    $status = ['0' => 'Gratis', '1' => 'Valor fijo', '2' => 'Valor variable por ubicación.', '3' => 'Envio Gratis / Monto Mínimo'];
    if(is_null($method)):
        return $status;
    else:
        return $status[$method];
    endif;
}

function getCoverageType($type= null)
{
    $status = ['0' => 'Estado', '1' => 'Ciudad'];
    if(is_null($type)):
        return $status;
    else:
        return $status[$type];
    endif;
}

function getCoverageStatus($status= null)
{
    $list = ['0' => 'No Activo', '1' => 'Activo'];
    if(is_null($status)):
        return $list;
    else:
        return $list[$status];
    endif;
}