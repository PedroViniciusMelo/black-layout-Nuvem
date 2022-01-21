<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class ImagemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Image::factory()->create([
            'name' => 'Nginx:latest',
            'photo' => 'imagens/nginx.png',
            'website' => 'https://www.nginx.com/',
            'description' => 'Nginx (pronounced "engine-x") is an open source reverse proxy server for HTTP, HTTPS, SMTP, POP3, and IMAP protocols, as well as a load balancer, HTTP cache, and a web server (origin server).',
            'from_image' => 'nginx',
            'tag' => 'latest',
            'user_type' => 'advanced',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Image::factory()->create([
            'name' => 'Wordpress',
            'photo' => 'imagens/wordpress.png',
            'website' => 'https://wordpress.com/pt-br/',
            'description' => 'WordPress é a mais popular  plataforma de publicação online. É open source, e utilizada por mais de 20% da Web.',
            'from_image' => 'gabriel31415/wordpressmysql',
            'tag' => '17.0',
            'user_type' => 'basic',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        Image::factory()->create([
            'name' => 'Drupal',
            'photo' => 'imagens/drupal1.jpeg',
            'website' => 'https://www.drupal.org/',
            'description' => 'Drupal é um software de gerenciamento de conteúdo. É usado para fazer muitos dos sites e aplicativos que você usa todos os dias.',
            'from_image' => 'gabriel31415/drupalmariadb',
            'tag' => '2.0',
            'user_type' => 'basic',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Image::factory()->create([
            'name' => 'Joomla!',
            'photo' => 'imagens/joomla.png',
            'website' => 'https://www.joomla.org/',
            'description' => 'Joomla! é um sistema de gerenciamento de conteúdo (CMS) gratuito e de código aberto para publicação de conteúdo da web. ',
            'from_image' => 'gabriel31415/joomlamariadb',
            'tag' => '3.0',
            'user_type' => 'basic',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
