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
        'administration' => 'Administración',    
        'user_management' => 'Gestión de usuarios',    
        'general' => 'General',
        'plans' => 'Gestión de Planes',
    ],

    'dashboard'   => 'Dashboard',

    'dashboard_var'   => [
        'peoplePerMonth' => 'Personas por mes',
        'meetingsPerMonth' => 'Reuniones por mes'
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

    'people'   => 'Persona|Personas',

    'people_var'   => [
        'identification' => 'Identificación',
        'first_name' => 'Nombres',
        'last_name' => 'Apellidos',
        'email' => 'Correo electrónico',
        'sex' => 'Sexo',
        'address' => 'Dirección',
        'birth' => 'Fecha de cumpleaños',
        'city' => 'Ciudad',
        'country' => 'País',
        'phone' => 'Teléfono',
        'photo' => 'Foto'
    ],

    'groups'   => 'Grupo|Grupos',
    'sub_groups'   => 'Subgrupo|Subgrupos',

    'groups_var'   => [
        'parent_id' => 'Grupo Padre',
        'identification' => 'Identificación',
        'name' => 'Nombre',
        'description' => 'Descripción',
        'subgroups' => 'Subgrupos'
    ],

    'features'   => 'Característica|Características',

    'features_var'   => [
        'name' => 'Nombre',
        'description' => 'Descripción'
    ],

    'profiles'   => 'Perfil|Perfiles',

    'profiles_var'   => [
        'name' => 'Nombre',
        'description' => 'Descripción'
    ],

    'meetings'   => 'Reunión|Reuniones',

    'meetings_var'   => [
        'user_id' => 'user_id',
        'person_id' => 'person_id',
        'name' => 'Título',
        'description' => 'Descripción',
        'date' => 'Fecha de la reunión',
        'time' => 'Hora de la reunión',
        'address' => 'Dirección',
        'latitude' => 'Latitud',
        'longitude' => 'Longitud'
    ],

    'meeting_reports'   => 'Reporte de reunión|Reportes de reunión',

    'meeting_reports_var'   => [
        'user_id' => 'user_id',
        'person_id' => 'person_id',
        'meeting_id' => 'meeting_id',
        'description' => 'Descripción'
    ],

    'assistants'   => 'Asistente|Asistentes',

    'assistants_var'   => [
        'person_id' => 'Persona',
        'meeting_id' => 'Identificador de Reunión',
        'confirmation' => 'Estado de asistencia'
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

    'gen_groups' => 'Grupo|Grupos',

    'gen_groups_var'   => [
        'group_cod' => 'group_cod',
        'group_description' => 'group_description',
        'enabled' => 'enabled'
    ],

    'gen_lists' => 'Lista|Listas',

    'gen_lists_var'   => [
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

    'plan_users' => 'Planes vs Usuarios',

    'plan_users_var'   => [
        'user_id' => 'Usuario',
        'plan_id' => 'Plan',
        'status' => 'Estatus',
        'date_activation' => 'Fecha de activación',
        'date_deadline' => 'Fecha de cierre'
    ],

];
