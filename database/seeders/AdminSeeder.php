<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::where("user_type", UserType::ADMIN->value)->delete();

        User::create([
            'first_name' => "مدیر",
            'last_name' => "وب‌سایت",
            "user_type" => UserType::ADMIN->value,
            "mobile" => "09386383927",
            "is_active" => 1,
            "password" => Hash::make("123456")
        ]);

    }
}
