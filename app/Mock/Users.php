<?php 

declare(strict_types=1);

namespace App\Mock;

class Users
{
    public static array $users = [
        [
            'id' => 1,
            'nickname' => 'CamilleClubLit',
            'email' => 'camilleClubLit@mail.com',
            'password' => 'suitedechainedecaracteres',
            'profil_picture_path' => './../public/uploads/users/pp1.jpg',
            'created_at' => '2026-06-10 12:34:56',
            'updated_at' => 'NULL',
            'status' => 'actif',

        ],

        [
            'id' => 2,
            'nickname' => 'Nathalie',
            'email' => 'nathalie@mail.com',
            'password' => 'suitedechainedecaracteres2',
            'profil_picture_path' => './../public/uploads/users/pp1.jpg',
            'created_at' => '2026-06-09 12:34:56',
            'updated_at' => 'NULL',
            'status' => 'actif',
        ],

        [
            'id' => 3,
            'nickname' => 'Alexlecture',
            'email' => 'alexlecture@mail.com',
            'password' => 'suitedechainedecaracteres3',
            'profil_picture_path' => './../public/uploads/users/pp1.jpg',
            'created_at' => '2026-06-10 11:34:56',
            'updated_at' => 'NULL',
            'status' => 'actif',
        ],

        [
            'id' => 4,
            'nickname' => 'Hugo1990_12',
            'email' => 'hugo1990_12@mail.com',
            'password' => 'suitedechainedecaracteres4',
            'profil_picture_path' => './../public/uploads/users/pp1.jpg',
            'created_at' => '2026-06-12 11:34:56',
            'updated_at' => 'NULL',
            'status' => 'actif',
        ]
    ];
}