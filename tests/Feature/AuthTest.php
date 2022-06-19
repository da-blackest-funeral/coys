<?php

    namespace Tests\Feature;

    use App\Models\User;
    use Illuminate\Foundation\Testing\DatabaseMigrations;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Tests\TestCase;

    class AuthTest extends TestCase
    {
        use RefreshDatabase, DatabaseMigrations;

        public function test_user_can_register(): void {
            $this->withoutExceptionHandling();
            $this->post(route('register'), [
                'name' => 'name',
                'email' => 'email@email.com',
                'password' => 'password',
                'password_confirmation' => 'password',
                'phone' => '+79184493137',
            ]);

            $this->assertDatabaseHas('users', ['id' => 1])
                ->assertAuthenticated('sanctum');
        }

        public function test_user_can_login() {
            $this->withoutExceptionHandling();
            $user = User::factory(1)->create()->first();

            $this->post(route('login', [
                'email' => $user->email,
                'password' => 'password'
            ]))->assertStatus(200);

            $this->assertAuthenticatedAs($user, 'sanctum');
        }
    }
