<?php

// Welcome In HeroAdmin Configurations

// Configs

    /**
        * In 'role_cont_' Use Separator '|' for Multiple Roles
        * To Config Online, Remove Any Configuration from here to Online Configs
          Warning Don't Remove The Configuration 'roles_cont_configs' and 'roles_see_heroadm'
    */

// Mbuilders

    /*
        Example: 
            [
                "type": "url",
                "link": "/",
                "icon": "fas fa-clock",
                "roles": "admin" // Use Separator '|' for Multiple Roles
            ]
    */


return [
    'configs' => [
        // Roles
            'roles_cont_configs' => 'admin', // Role Controlling Online Configs
            'roles_cont_users' => 'admin', // Role Controlling Users
            'roles_cont_medias' => 'admin',  // Role Controlling Medias
            'roles_see_heroadm' => 'admin', // Role Controlling Medias
        // Site Configuration
            'title' => env('APP_NAME', 'Laravel'),
            'herotitle' => env('APP_NAME', 'Laravel') + 'herotitle',
        // HERO Admin Auth
            'max_session_life' => 900000,
    ],
    'mbuilders' => [
        // Mbuilders
    ]
];