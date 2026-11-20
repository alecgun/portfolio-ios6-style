<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\NotesSection;
use App\Models\Profile;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use RuntimeException;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminName = (string) config('portfolio.admin.name');
        $adminEmail = trim((string) config('portfolio.admin.email'));
        $adminPassword = (string) config('portfolio.admin.password');

        if (filter_var($adminEmail, FILTER_VALIDATE_EMAIL) === false || Str::length($adminPassword) < 16) {
            throw new RuntimeException('Set a valid ADMIN_EMAIL and an ADMIN_PASSWORD of at least 16 characters before seeding.');
        }

        $user = User::firstOrCreate(
            ['email' => $adminEmail],
            [
                'name' => $adminName,
                'password' => Hash::make($adminPassword),
            ]
        );

        // 2. Profile
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

        // 3. Skills
        $skills = [
            [
                'title' => 'UI/UX Design',
                'description' => 'Figma, Prototyping, Design Systems, Micro-interactions',
                'icon_class' => 'fa-solid fa-pen-nib',
                'bg_gradient' => 'sky-blue',
                'sort_order' => 1,
            ],
            [
                'title' => 'Frontend',
                'description' => 'React, Next.js, TypeScript, Tailwind CSS',
                'icon_class' => 'fa-solid fa-code',
                'bg_gradient' => 'amber-orange',
                'sort_order' => 2,
            ],
            [
                'title' => 'iOS & Mobile',
                'description' => 'SwiftUI, React Native, Flutter, iOS Guidelines',
                'icon_class' => 'fa-solid fa-mobile-screen-button',
                'bg_gradient' => 'lime-green',
                'sort_order' => 3,
            ],
            [
                'title' => 'Motion 3D',
                'description' => 'Framer Motion, Three.js, GSAP, Spline',
                'icon_class' => 'fa-solid fa-wand-magic-sparkles',
                'bg_gradient' => 'fuchsia-purple',
                'sort_order' => 4,
            ],
            [
                'title' => 'Backend',
                'description' => 'Node.js, PostgreSQL, Supabase, GraphQL',
                'icon_class' => 'fa-solid fa-server',
                'bg_gradient' => 'slate-gray',
                'sort_order' => 5,
            ],
            [
                'title' => 'Strategi',
                'description' => 'User Research, A/B Testing, Web Performance',
                'icon_class' => 'fa-solid fa-chart-pie',
                'bg_gradient' => 'rose-red',
                'sort_order' => 6,
            ],
        ];

        foreach ($skills as $skill) {
            Skill::updateOrCreate(['title' => $skill['title']], $skill);
        }

        // 4. Experiences
        $experiences = [
            [
                'role_title' => 'Lead UI Engineer',
                'company_name' => 'Studio Nusantara',
                'period' => '2023 – Sekarang',
                'sort_order' => 1,
            ],
            [
                'role_title' => 'Frontend Developer',
                'company_name' => 'Kreasi Digital',
                'period' => '2020 – 2023',
                'sort_order' => 2,
            ],
        ];

        foreach ($experiences as $exp) {
            Experience::updateOrCreate(
                ['role_title' => $exp['role_title'], 'company_name' => $exp['company_name']],
                $exp
            );
        }

        // 5. Notes Section
        NotesSection::updateOrCreate(
            ['id' => 1],
            [
                'header_title' => 'Catatan Karier & Filosofi',
                'date_label' => '20 Nov 2026',
                'main_heading' => 'Mengapa Detail Kecil Sangat Berarti?',
                'content' => 'Sejak era awal komputasi personal dan mobile, antarmuka terbaik adalah antarmuka yang terasa akrab di tangan. Saya percaya desain yang baik tidak hanya rata dan minimal, tetapi memberikan umpan balik visual yang jelas—seperti tombol yang terasa bisa ditekan dan hierarki informasi yang jujur.',
            ]
        );
    }
}
