<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Functionalities titles
    |--------------------------------------------------------------------------
    |
    |
    */
   	'create' => 'Crear',
   	'edit' => 'Editar',
   	'detail' => 'Detalles',
    'action' => 'Acciones',

   	'created_at' => 'Creado en',
   	'updated_at' => 'Actualizado en',

    'menu_admin'   => [
        'administrator' => 'Administrador',    
        'user_management' => 'Gestión de usuarios',    
        'general' => 'General',
        'plans' => 'Gestión de Planes',
    ],
   
    'communities'   => 'Comunidad|Comunidades',

    'communities_var'   => [
    	'identification' => 'Identificación',
        'name' => 'Nombre',
        'description' => 'Descripción',
        'address' => 'Dirección',
        'latitude' => 'Latitud',
        'longitude' => 'Longitud'
    ],

    'users'   => 'Usuario|Usuarios',

    'users_var'   => [
        'first_name' => 'Nombres',
        'last_name' => 'Apellido',
        'username' => 'Usuario',
        'email' => 'Correo electrónico',
        'password' => 'Contraseña',
        'phone' => 'Teléfono',
        'roles' => 'Roles',
    ],

    'roles' => 'Rol|Roles',

    'roles_var'   => [
        'name' => 'Nombre',
        'title' => 'Título',
        'level' => 'level',
        'scope' => 'scope',
        'abilities' => 'Habilidades'
    ],

    'abilities' => 'Habilidad|Habilidades',

    'abilities_var'   => [
        'name' => 'Nombre',
        'title' => 'Título',
        'entity_id' => 'entity_id',
        'entity_type' => 'entity_type',
        'only_owned' => 'only_owned',
        'options' => 'options',
        'scope' => 'scope',
    ],

    'gen_group' => 'Grupo|Grupos',

    'gen_group_var'   => [
        'group_cod' => 'group_cod',
        'group_description' => 'group_description',
        'enabled' => 'enabled'
    ],

    'gen_list' => 'Lista|Listas',

    'gen_list_var'   => [
        'group_id' => 'group_id',
        'item_id' => 'item_id',
        'item_description' => 'item_description',
        'item_cod' => 'item_cod',
        'enabled' => 'enabled'
    ],

    'plans' => 'Plan|Planes',

    'plans_var'   => [
        'identification' => 'Identificación',
        'name' => 'Nombre del plan',
        'price' => 'Precio',
        'q_users' => 'Cant. Usuarios',
        'q_administrators' => 'Cant. Administradores',
        'q_communities' => 'Cant. Comunidades'
    ],

    'plan_user' => 'Planes vs Usuarios',

    'plan_user_var'   => [
        'user_id' => 'Usuario',
        'plan_id' => 'Plan',
        'status' => 'Estatus',
        'date_activation' => 'Fecha de activación',
        'date_deadline' => 'Fecha de cierre'
    ],

];
