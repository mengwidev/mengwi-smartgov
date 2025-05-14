<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactType;

class ContactTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            // Mobile & Messaging
            'Handphone',
            'Telephone',
            'WhatsApp',
            'Telegram',

            // Emails & Web
            'Email',
            'Website',
            'Blog',

            // Social Media
            'Facebook',
            'Instagram',
            'X',
            'LinkedIn',
            'YouTube',
            'TikTok',
            'Snapchat',
            'Pinterest',

            // Communication Platforms
            'Discord',
            'Slack',
            'Skype',
            'Zoom',
            'Google Meet',
            'Microsoft Teams',

            // Developer/Tech
            'GitHub',
            'GitLab',
            'Bitbucket',
            'Stack Overflow',
        ];

        foreach ($types as $name) {
            $model = ContactType::firstOrCreate(['name' => $name]);
            echo $model->wasRecentlyCreated
                ? "Inserted: {$model->name}\n"
                : "Skipped (exists): {$model->name}\n";
        }
    }
}
