<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Password;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    private function buatUser(array $override = []): User
    {
        return User::forceCreate(array_merge([
            'name' => 'Budi Senja',
            'email' => 'budi@example.com',
            'password' => 'Rahasia123',
            'is_admin' => false,
        ], $override));
    }

    public function test_registrasi_dengan_data_valid(): void
    {
        $this->post('/register', [
            'name' => 'Pengguna Baru',
            'email' => 'baru@example.com',
            'password' => 'Rahasia123',
            'password_confirmation' => 'Rahasia123',
        ])->assertRedirect('/');

        $this->assertAuthenticated();
        $user = User::where('email', 'baru@example.com')->firstOrFail();
        $this->assertFalse($user->is_admin);
        $this->assertNotEquals('Rahasia123', $user->password);
    }

    public function test_registrasi_email_duplikat_ditolak(): void
    {
        $this->buatUser();

        $this->post('/register', [
            'name' => 'Lainnya',
            'email' => 'budi@example.com',
            'password' => 'Rahasia123',
            'password_confirmation' => 'Rahasia123',
        ])->assertSessionHasErrors('email');
    }

    public function test_registrasi_password_lemah_ditolak(): void
    {
        $this->post('/register', [
            'name' => 'Lemah',
            'email' => 'lemah@example.com',
            'password' => 'abcdefgh',
            'password_confirmation' => 'abcdefgh',
        ])->assertSessionHasErrors('password');

        $this->post('/register', [
            'name' => 'Pendek',
            'email' => 'pendek@example.com',
            'password' => 'Ab1',
            'password_confirmation' => 'Ab1',
        ])->assertSessionHasErrors('password');

        $this->post('/register', [
            'name' => 'Beda',
            'email' => 'beda@example.com',
            'password' => 'Rahasia123',
            'password_confirmation' => 'Rahasia124',
        ])->assertSessionHasErrors('password');
    }

    public function test_registrasi_tidak_bisa_menentukan_role_sendiri(): void
    {
        $this->post('/register', [
            'name' => 'Penjahat',
            'email' => 'penjahat@example.com',
            'password' => 'Rahasia123',
            'password_confirmation' => 'Rahasia123',
            'is_admin' => '1',
        ]);

        $this->assertFalse(User::where('email', 'penjahat@example.com')->firstOrFail()->is_admin);
    }

    public function test_login_dengan_kredensial_valid(): void
    {
        $this->buatUser();

        $this->post('/login', [
            'email' => 'budi@example.com',
            'password' => 'Rahasia123',
        ])->assertRedirect('/');

        $this->assertAuthenticated();
    }

    public function test_login_password_salah(): void
    {
        $this->buatUser();

        $this->post('/login', [
            'email' => 'budi@example.com',
            'password' => 'Salah123',
        ])->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_logout_mengakhiri_session(): void
    {
        $user = $this->buatUser();

        $this->actingAs($user)
            ->post('/logout')
            ->assertRedirect('/');

        $this->assertGuest();
    }

    public function test_guest_dialihkan_dari_halaman_yang_butuh_auth(): void
    {
        $this->get('/admin/menus')->assertRedirect(route('admin.login'));
    }

    public function test_pengguna_login_diarahkan_dari_halaman_login(): void
    {
        $user = $this->buatUser();

        $this->actingAs($user)->get('/login')->assertRedirect('/');
        $this->actingAs($user)->get('/register')->assertRedirect('/');
    }

    public function test_permintaan_reset_password_mengirim_notifikasi(): void
    {
        Notification::fake();

        $user = $this->buatUser();

        $this->post('/password/email', ['email' => 'budi@example.com']);

        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_reset_password_dengan_token_valid(): void
    {
        $user = $this->buatUser();
        $token = Password::broker()->createToken($user);

        $this->post('/password/reset', [
            'token' => $token,
            'email' => 'budi@example.com',
            'password' => 'Baru1234',
            'password_confirmation' => 'Baru1234',
        ])->assertRedirect('/');

        $this->assertTrue(
            \Illuminate\Support\Facades\Hash::check('Baru1234', $user->fresh()->password)
        );
    }

    public function test_reset_password_token_tidak_valid(): void
    {
        $this->buatUser();

        $this->post('/password/reset', [
            'token' => 'token-asal-asalan',
            'email' => 'budi@example.com',
            'password' => 'Baru1234',
            'password_confirmation' => 'Baru1234',
        ])->assertSessionHasErrors('email');
    }

    public function test_katalog_publik_tetap_bisa_diakses_guest(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_halaman_pengelolaan_menu_tetap_terlindungi(): void
    {
        $user = $this->buatUser();

        $this->actingAs($user)->get('/admin/menus')->assertForbidden();
    }
}
