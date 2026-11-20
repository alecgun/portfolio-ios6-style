<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('full_name');
            $table->string('role_badge')->default('Product Designer & Frontend Engineer');
            $table->string('headline')->default('Halo, Saya Raka Pratama');
            $table->text('bio');
            $table->string('avatar_path')->nullable();
            $table->string('cv_pdf_path')->nullable();
            $table->string('cv_version_label')->default('v6.1.3');
            $table->boolean('is_open_to_work')->default(true);
            $table->boolean('is_freelance_available')->default(true);
            $table->string('freelance_period_text')->default('Tersedia untuk Q4 2026');
            $table->string('location_base')->default('Jawa Timur, Indonesia (WIB)');
            $table->timestamps();
        });

        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->string('icon_class')->default('fa-solid fa-code');
            $table->string('bg_gradient')->default('sky-blue');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category')->default('app'); // 'app', 'web', 'other'
            $table->string('category_badge')->default('iOS & Web App');
            $table->string('thumbnail_path')->nullable();
            $table->text('short_description');
            $table->longText('full_description')->nullable();
            $table->string('tech_stack')->default('React • TypeScript');
            $table->string('project_url')->nullable();
            $table->string('github_url')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('role_title');
            $table->string('company_name');
            $table->string('period');
            $table->text('summary')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('notes_sections', function (Blueprint $table) {
            $table->id();
            $table->string('header_title')->default('Catatan Karier & Filosofi');
            $table->string('date_label')->default('20 Nov 2026');
            $table->string('main_heading')->default('Mengapa Detail Kecil Sangat Berarti?');
            $table->longText('content');
            $table->timestamps();
        });

        Schema::create('contact_messages', function (Blueprint $table) {
            $table->id();
            $table->string('sender_name');
            $table->string('sender_email');
            $table->text('message');
            $table->string('ip_address')->nullable();
            $table->boolean('is_read')->default(false);
            $table->timestamp('replied_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact_messages');
        Schema::dropIfExists('notes_sections');
        Schema::dropIfExists('experiences');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('skills');
        Schema::dropIfExists('profiles');
    }
};
