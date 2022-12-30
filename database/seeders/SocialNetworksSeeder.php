<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialNet;

class SocialNetworksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SocialNet::create([
            'name' => 'Facebook',
            'icon' => 'fab fa-facebook-f',
            'url' => 'https://www.facebook.com/',
        ]);

        SocialNet::create([
            'name' => 'Twitter',
            'icon' => 'fab fa-twitter',
            'url' => 'https://twitter.com/',
        ]);

        SocialNet::create([
            'name' => 'Instagram',
            'icon' => 'fab fa-instagram',
            'url' => 'https://www.instagram.com/',
        ]);
        SocialNet::create([
            'name' => 'LinkedIn',
            'icon' => 'fab fa-linkedin-in',
            'url' => 'https://www.linkedin.com/',
        ]);

        SocialNet::create([
            'name' => 'YouTube',
            'icon' => 'fab fa-youtube',
            'url' => 'https://www.youtube.com/',
        ]);

        SocialNet::create([
            'name' => 'Pinterest',
            'icon' => 'fab fa-pinterest-p',
            'url' => 'https://www.pinterest.com/',
        ]);

        SocialNet::create([
            'name' => 'Snapchat',
            'icon' => 'fab fa-snapchat-ghost',
            'url' => 'https://www.snapchat.com/',
        ]);

        SocialNet::create([
            'name' => 'WhatsApp',
            'icon' => 'fab fa-whatsapp',
            'url' => 'https://www.whatsapp.com/',
        ]);

        SocialNet::create([
            'name' => 'TikTok',
            'icon' => 'fab fa-tiktok',
            'url' => 'https://www.tiktok.com/',
        ]);

        SocialNet::create([
            'name' => 'Telegram',
            'icon' => 'fab fa-telegram-plane',
            'url' => 'https://www.telegram.org/',
        ]);

        SocialNet::create([
            'name' => 'GitHub',
            'icon' => 'fab fa-github',
            'url' => 'https://www.github.com/',
        ]);

        SocialNet::create([
            'name' => 'Reddit',
            'icon' => 'fab fa-reddit-alien',
            'url' => 'https://www.reddit.com/',
        ]);

        SocialNet::create([
            'name' => 'Discord',
            'icon' => 'fab fa-discord',
            'url' => 'https://www.discord.com/',
        ]);
        SocialNet::create([
            'name' => 'Twitch',
            'icon' => 'fab fa-twitch',
            'url' => 'https://www.twitch.tv/',
        ]);

        SocialNet::create([
            'name' => 'Spotify',
            'icon' => 'fab fa-spotify',
            'url' => 'https://www.spotify.com/',
        ]);

        SocialNet::create([
            'name' => 'Vimeo',
            'icon' => 'fab fa-vimeo-v',
            'url' => 'https://vimeo.com/',
        ]);
        SocialNet::create([
            'name' => 'Otros',
            'icon' => 'fas fa-link',
            'url' => '#',
        ]);

        SocialNet::create([
            'name' => 'ArtStation',
            'icon' => 'fab fa-artstation',
            'url' => 'https://www.artstation.com/',
        ]);
    }
}
