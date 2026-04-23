<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_access_profile_page(): void
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->actingAs($user)->get(route('profile.edit'));

        $response->assertStatus(200);
        $response->assertSee('My Profile');
    }

    public function test_guest_cannot_access_profile_page(): void
    {
        $response = $this->get(route('profile.edit'));

        $response->assertRedirect(route('login'));
    }

    public function test_user_can_update_name_and_email(): void
    {
        $user = User::create([
            'name' => 'Old Name',
            'email' => 'old@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->actingAs($user)->patch(route('profile.update'), [
            'name' => 'New Name',
            'email' => 'new@example.com',
        ]);

        $response->assertSessionHas('success', 'Profile updated successfully.');
        $response->assertRedirect();

        $user->refresh();

        $this->assertSame('New Name', $user->name);
        $this->assertSame('new@example.com', $user->email);
    }

    public function test_user_cannot_use_existing_email(): void
    {
        User::create([
            'name' => 'First User',
            'email' => 'first@example.com',
            'password' => Hash::make('password123'),
        ]);

        $user = User::create([
            'name' => 'Second User',
            'email' => 'second@example.com',
            'password' => Hash::make('password123'),
        ]);

        $response = $this->actingAs($user)->patch(route('profile.update'), [
            'name' => 'Second User',
            'email' => 'first@example.com',
        ]);

        $response->assertSessionHasErrors('email');
    }
}
