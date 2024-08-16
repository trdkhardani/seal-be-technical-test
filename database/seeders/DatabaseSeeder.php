<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Position;
use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Position::create([
            'position_id' => '137c4bf6-328d-448e-9856-3a55327a4b14',
            'position_name' => 'Project Manager',
        ]);

        Position::create([
            'position_id' => 'c713b931-7db4-41bf-8c3d-d49dbe12f10b',
            'position_name' => 'Back-End',
        ]);

        Position::create([
            'position_id' => '0178bcca-d323-4e0b-b366-9252329c2dca',
            'position_name' => 'Front-End',
        ]);

        Position::create([
            'position_id' => '48b18305-0e9c-402e-851a-c213a75adb4e',
            'position_name' => 'QA',
        ]);

        Position::create([
            'position_id' => 'a8ef8861-08a4-472d-953b-3367ed04b3ea',
            'position_name' => 'Fullstack',
        ]);

        Position::create([
            'position_id' => 'b9c6bf70-bc66-4ac0-8eb4-ff80fb76d755',
            'position_name' => 'UI/UX',
        ]);

        Position::create([
            'position_id' => 'fdcf07c3-8436-4ad4-8c80-b0e0c90c8c6e',
            'position_name' => 'Mobile',
        ]);

        User::create([
            'user_id' => '2a10d499-55f8-49a7-b758-3aa0ff2aee46',
            'position_id' => '137c4bf6-328d-448e-9856-3a55327a4b14',
            'name' => 'Oman Narpati',
            'username' => 'oman123',
            'user_photo' => 'user-photos/oman123-2prUDB5894ywu5p',
            'email' => 'oman@company.id',
            'password' => bcrypt('password'),
            'user_role' => 'Leader'
        ]);
    }
}
