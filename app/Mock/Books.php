<?php 

declare(strict_types=1);

namespace App\Mock;

class Books
{
    public static array $books = [
        [
            'id' => 1,
            'user_id' => 1,
            'title' => 'Esther',
            'author' => 'Alabaster',
            'availability' => 1,
            'cover_picture_path' => './../public/uploads/books/livre1.jpg',
            'created_at' => '2026-06-11 12:34:56',
            'updated_at' => 'NULL',
            'description' => "J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager des moments authentiques autour de la table.
                                Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité.
                                Chaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers.
                                'The Kinfolk Table' incarne parfaitement l'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes."
        ],

        [
            'id' => 2,
            'user_id' => 2,
            'title' => 'The Kinfolk Table',
            'author' => 'Nathan Williams',
            'availability' => 1,
            'cover_picture_path' => './../public/uploads/books/livre2.jpg',
            'created_at' => '2026-06-11 11:34:56',
            'updated_at' => 'NULL',
            'description' => "J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager des moments authentiques autour de la table. 
                                Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. 
                                Chaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. 
                                'The Kinfolk Table' incarne parfaitement l'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes."
        ],

        [
            'id' => 3,
            'user_id' => 3,
            'title' => 'Wabi Sabi',
            'author' => 'Beth Kempton',
            'availability' => 1,
            'cover_picture_path' => './../public/uploads/books/livre3.jpg',
            'created_at' => '2026-06-11 10:34:56',
            'updated_at' => 'NULL',
            'description' => "J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager des moments authentiques autour de la table. 
                                Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. 
                                Chaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. 
                                'The Kinfolk Table' incarne parfaitement l'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes."
        ],

        [
            'id' => 4,
            'user_id' => 4,
            'title' => 'Milk & honey',
            'author' => 'Rupi Kaur',
            'availability' => 1,
            'cover_picture_path' => './../public/uploads/books/livre4.jpg',
            'created_at' => '2026-06-11 09:34:56',
            'updated_at' => 'NULL',
            'description' => "J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager des moments authentiques autour de la table. 
                                Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. 
                                Chaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. 
                                'The Kinfolk Table' incarne parfaitement l'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes."
        ],
        [
            'id' => 5,
            'user_id' => 1,
            'title' => 'Esther2',
            'author' => 'AlabasterBis',
            'availability' => 1,
            'cover_picture_path' => './../public/uploads/books/livre1.jpg',
            'created_at' => '2026-06-10 12:34:56',
            'updated_at' => 'NULL',
            'description' => "J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager des moments authentiques autour de la table. 
                                Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. 
                                Chaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. 
                                'The Kinfolk Table' incarne parfaitement l'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes."
        ],

        [
            'id' => 6,
            'user_id' => 2,
            'title' => 'The Kinfolk Table',
            'author' => 'Nathan Williams',
            'availability' => 1,
            'cover_picture_path' => './../public/uploads/books/livre2.jpg',
            'created_at' => '2026-06-11 11:34:56',
            'updated_at' => 'NULL',
            'description' => "J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager des moments authentiques autour de la table. 
                                Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. 
                                Chaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. 
                                'The Kinfolk Table' incarne parfaitement l'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes."
        ],

        [
            'id' => 7,
            'user_id' => 3,
            'title' => 'Wabi Sabi',
            'author' => 'Beth Kempton',
            'availability' => 1,
            'cover_picture_path' => './../public/uploads/books/livre3.jpg',
            'created_at' => '2026-06-11 10:34:56',
            'updated_at' => 'NULL',
            'description' => "J'ai récemment plongé dans les pages de 'The Kinfolk Table' et j'ai été enchanté par cette œuvre captivante. Ce livre va bien au-delà d'une simple collection de recettes ; il célèbre l'art de partager des moments authentiques autour de la table. 
                                Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité. 
                                Chaque page est une invitation à ralentir, à savourer et à créer des souvenirs durables avec les êtres chers. 
                                'The Kinfolk Table' incarne parfaitement l'esprit de la cuisine et de la camaraderie, et il est certain que ce livre trouvera une place spéciale dans le cœur de tout amoureux de la cuisine et des rencontres inspirantes."
        ]
    ];
}