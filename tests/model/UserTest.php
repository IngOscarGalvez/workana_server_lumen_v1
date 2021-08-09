<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{


    /**
     * A basic test example.
     *
     * @return void
     */

    public function testUserCreate()
    {
        User::factory()->create([
            'email' => 'test@test.com'
        ]);

        $this->seeInDatabase('users', ['email' => 'test@test.com']);
    }

    public function testUserUpdate()
    {
        User::factory()->create([
            'email' => 'test@test.com'
        ]);
        $user = User::where('email', 'test@test.com')->first();
        $user->email = 'update@test.com';
        $user->save();
        $this->seeInDatabase('users', ['email' => 'update@test.com']);
    }

    public function testUserDelete()
    {
        User::factory()->create([
            'email' => 'test@test.com'
        ]);
        $user = User::where('email', 'test@test.com')->first();
        $user->delete();
        $this->notSeeInDatabase('users', ['email' => 'test@test.com']);
    }
}
