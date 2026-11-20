<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\User;
use Database\Seeders\PortfolioSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class PortfolioTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(PortfolioSeeder::class);
    }

    public function test_public_homepage_renders_successfully()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Portofolio.app');
        $response->assertSee('Raka Pratama');
        $response->assertDontSee('FinTrack Ledger');
        $response->assertSee('UI/UX Design');

        $this->assertDatabaseMissing('projects', [
            'slug' => 'fintrack-ledger',
        ]);
    }

    public function test_portfolio_seeder_rejects_an_admin_password_shorter_than_16_characters()
    {
        config(['portfolio.admin.password' => 'short']);

        $this->expectException(\RuntimeException::class);

        $this->seed(PortfolioSeeder::class);
    }

    public function test_unknown_page_renders_the_custom_not_found_page()
    {
        $response = $this->get('/page-that-does-not-exist');

        $response->assertNotFound();
        $response->assertSee('Halaman tidak ditemukan');
        $response->assertSee('Kembali ke halaman utama');
    }

    public function test_contact_form_submission_stores_message()
    {
        $payload = [
            'sender_name' => 'Budi Santoso',
            'sender_email' => 'budi@example.com',
            'message' => 'Halo, saya ingin mendiskusikan proyek web baru.',
        ];

        $response = $this->postJson('/contact', $payload);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
        ]);

        $this->assertDatabaseHas('contact_messages', [
            'sender_email' => 'budi@example.com',
        ]);
    }

    public function test_download_cv_endpoint_responds()
    {
        $response = $this->get('/download-cv');
        $response->assertStatus(200);
    }

    public function test_unauthenticated_user_cannot_access_admin_dashboard()
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect('/admin/login');
    }

    public function test_admin_can_login_with_valid_credentials()
    {
        $response = $this->post('/admin/login', [
            'email' => 'admin@portfolio.local',
            'password' => 'portfolio-test-password-123',
        ]);

        $response->assertRedirect('/admin/dashboard');
        $this->assertAuthenticated();
    }

    public function test_admin_dashboard_renders_for_authenticated_user()
    {
        $user = User::where('email', 'admin@portfolio.local')->first();

        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Ringkasan Dashboard');
        $response->assertSee('Raka Pratama');
    }

    public function test_admin_can_update_profile()
    {
        $user = User::where('email', 'admin@portfolio.local')->first();

        $response = $this->actingAs($user)->put('/admin/profile', [
            'full_name' => 'Raka Pratama Updated',
            'role_badge' => 'Senior Fullstack Engineer',
            'headline' => 'Halo, Selamat Datang di Dunia Interaktif Saya',
            'bio' => 'Bio baru yang diperbarui dari admin.',
            'cv_version_label' => 'v6.2.0',
            'is_open_to_work' => '1',
            'is_freelance_available' => '1',
            'freelance_period_text' => 'Tersedia untuk 2027',
            'location_base' => 'Jakarta, Indonesia',
        ]);

        $response->assertRedirect('/admin/profile');
        $this->assertDatabaseHas('profiles', [
            'full_name' => 'Raka Pratama Updated',
            'role_badge' => 'Senior Fullstack Engineer',
            'cv_version_label' => 'v6.2.0',
        ]);
    }

    public function test_admin_can_create_new_project()
    {
        $user = User::where('email', 'admin@portfolio.local')->first();

        $response = $this->actingAs($user)->post('/admin/projects', [
            'title' => 'Project Alpha Test',
            'category' => 'app',
            'category_badge' => 'Mobile App',
            'short_description' => 'Aplikasi test untuk otomatisasi.',
            'full_description' => 'Deskripsi lengkap aplikasi.',
            'tech_stack' => 'Flutter • Laravel',
            'project_url' => 'https://example.com',
            'sort_order' => 10,
            'is_published' => '1',
        ]);

        $response->assertRedirect('/admin/projects');
        $this->assertDatabaseHas('projects', [
            'title' => 'Project Alpha Test',
            'category' => 'app',
        ]);
    }

    public function test_admin_can_manage_skills()
    {
        $user = User::where('email', 'admin@portfolio.local')->first();

        $response = $this->actingAs($user)->post('/admin/skills', [
            'title' => 'DevOps Cloud',
            'description' => 'Docker, Kubernetes, AWS, CI/CD',
            'icon_class' => 'fa-solid fa-cloud',
            'bg_gradient' => 'sky-blue',
            'sort_order' => 7,
            'is_active' => '1',
        ]);

        $response->assertRedirect('/admin/skills');
        $this->assertDatabaseHas('skills', [
            'title' => 'DevOps Cloud',
        ]);
    }

    public function test_admin_can_manage_experiences()
    {
        $user = User::where('email', 'admin@portfolio.local')->first();

        $response = $this->actingAs($user)->post('/admin/experiences', [
            'role_title' => 'Principal Architect',
            'company_name' => 'Tech Corp Global',
            'period' => '2026 – Sekarang',
            'summary' => 'Memimpin arsitektur aplikasi berskala besar.',
            'sort_order' => 0,
        ]);

        $response->assertRedirect('/admin/experiences');
        $this->assertDatabaseHas('experiences', [
            'role_title' => 'Principal Architect',
        ]);
    }

    public function test_admin_can_update_notes_section()
    {
        $user = User::where('email', 'admin@portfolio.local')->first();

        $response = $this->actingAs($user)->put('/admin/notes', [
            'header_title' => 'Catatan Filosofi Baru',
            'date_label' => '21 Nov 2026',
            'main_heading' => 'Prinsip Desain Tanpa Batas',
            'content' => 'Setiap baris kode dan setiap bayangan piksel memiliki tujuan estetika dan kegunaan.',
        ]);

        $response->assertRedirect('/admin/notes');
        $this->assertDatabaseHas('notes_sections', [
            'header_title' => 'Catatan Filosofi Baru',
            'main_heading' => 'Prinsip Desain Tanpa Batas',
        ]);
    }

    public function test_admin_can_view_and_delete_message()
    {
        $user = User::where('email', 'admin@portfolio.local')->first();

        $message = ContactMessage::create([
            'sender_name' => 'Klien Prospektif',
            'sender_email' => 'klien@example.com',
            'message' => 'Penawaran kerja sama desain.',
        ]);

        $response = $this->actingAs($user)->get("/admin/messages/{$message->id}");
        $response->assertStatus(200);
        $response->assertSee('Klien Prospektif');

        // Verify message is marked read
        $this->assertTrue($message->fresh()->is_read);

        // Delete message
        $delResponse = $this->actingAs($user)->delete("/admin/messages/{$message->id}");
        $delResponse->assertRedirect('/admin/messages');
        $this->assertDatabaseMissing('contact_messages', ['id' => $message->id]);
    }

    public function test_admin_can_view_account_settings()
    {
        $user = User::where('email', 'admin@portfolio.local')->first();

        $response = $this->actingAs($user)->get('/admin/account');
        $response->assertStatus(200);
        $response->assertSee('Pengaturan Akun & Keamanan');
        $response->assertSee($user->email);
    }

    public function test_admin_can_update_name_and_email()
    {
        $user = User::where('email', 'admin@portfolio.local')->first();

        $response = $this->actingAs($user)->put('/admin/account', [
            'name' => 'Owner Baru',
            'email' => 'owner@portfolio.local',
        ]);

        $response->assertRedirect('/admin/account');
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'Owner Baru',
            'email' => 'owner@portfolio.local',
        ]);
    }

    public function test_admin_can_update_password_with_valid_current_password()
    {
        $user = User::where('email', 'admin@portfolio.local')->first();

        $response = $this->actingAs($user)->put('/admin/account', [
            'name' => $user->name,
            'email' => $user->email,
            'current_password' => 'portfolio-test-password-123',
            'new_password' => 'secret999',
            'new_password_confirmation' => 'secret999',
        ]);

        $response->assertRedirect('/admin/account');
        $this->assertTrue(Hash::check('secret999', $user->fresh()->password));
    }

    public function test_admin_cannot_update_password_with_invalid_current_password()
    {
        $user = User::where('email', 'admin@portfolio.local')->first();

        $response = $this->actingAs($user)->put('/admin/account', [
            'name' => $user->name,
            'email' => $user->email,
            'current_password' => 'wrongpassword',
            'new_password' => 'secret999',
            'new_password_confirmation' => 'secret999',
        ]);

        $response->assertSessionHasErrors('current_password');
    }

    public function test_admin_can_logout()
    {
        $user = User::where('email', 'admin@portfolio.local')->first();

        $response = $this->actingAs($user)->post('/admin/logout');
        $response->assertRedirect('/admin/login');
        $this->assertGuest();
    }
}
