<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RuntimeException;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $adminName = (string) config('portfolio.admin.name');
        $adminEmail = trim((string) config('portfolio.admin.email'));
        $adminPassword = (string) config('portfolio.admin.password');

        if (filter_var($adminEmail, FILTER_VALIDATE_EMAIL) === false || Str::length($adminPassword) < 8) {
            throw new RuntimeException('Set a valid ADMIN_EMAIL and an ADMIN_PASSWORD of at least 8 characters before seeding.');
        }

        $user = User::firstOrCreate(
            ['email' => $adminEmail],
            [
                'name' => $adminName,
                'password' => Hash::make($adminPassword),
            ]
        );

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'full_name' => 'Raka Pratama',
                'role_badge' => 'Product Designer & Frontend Engineer',
                'headline' => 'Halo, Saya Raka Pratama',
                'bio' => 'Merancang pengalaman digital yang taktil, intuitif, dan berkarakter. Memadukan kehangatan detail antarmuka klasik dengan performa web modern yang presisi.',
                'avatar_path' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=300&q=80',
                'cv_pdf_path' => null,
                'cv_version_label' => 'v6.1.3',
                'is_open_to_work' => true,
                'is_freelance_available' => true,
                'freelance_period_text' => 'Tersedia untuk Q4 2026',
                'location_base' => 'Jawa Timur, Indonesia (WIB)',
            ]
        );
    }
}
