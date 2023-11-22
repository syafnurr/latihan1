<?php

namespace Database\Seeders;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create the root admin with system admin credentials (do not delete)
        $admin = Admin::create([
            'name' => 'System Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('welcome123'),
            'role' => 1, // 1 = admin
            'email_verified_at' => Carbon::now('UTC'),
            'is_active' => true,
            'is_undeletable' => true,
            'is_uneditable' => config('default.app_demo'),
            'created_at' => Carbon::now('UTC'),
            'locale' => config('app.locale'),
            'currency' => config('default.currency'),
            'time_zone' => config('default.time_zone'),
        ]);

        if (config('default.app_demo')) {
            $avatar = storage_path('demo-images/avatars/men/1.jpg');

            $admin
                ->addMedia($avatar)
                ->preservingOriginal()
                ->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                })
                ->toMediaCollection('avatar', 'files');

            // Create additional admins for demo purposes
            for ($i = 0; $i < 2; $i++) {
                $gender = (fake()->boolean) ? 'male' : 'female';
                $created_at = fake()->dateTimeBetween('-78 week', '-6 week');
                $admin = Admin::create([
                    'name' => fake()->name($gender),
                    'email' => fake()->unique()->safeEmail(),
                    'password' => bcrypt('welcome123'),
                    'role' => 2, // 2 = manager
                    'email_verified_at' => $created_at,
                    'is_active' => true, //fake()->boolean(70),
                    'is_undeletable' => true,
                    'is_uneditable' => true,
                    'created_at' => $created_at,
                    'locale' => config('app.locale'),
                    'currency' => config('default.currency'),
                    'time_zone' => config('default.time_zone'),
                ]);

                // Randomly generate an avatar for some of the admins
                if (fake()->boolean(70)) {
                    $genderDir = ($gender == 'male') ? 'men' : 'women';
                    $avatar = storage_path("demo-images/avatars/$genderDir/".fake()->numberBetween(2, 99).'.jpg');

                    $admin
                        ->addMedia($avatar)
                        ->preservingOriginal()
                        ->sanitizingFileName(function ($fileName) {
                            return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                        })
                        ->toMediaCollection('avatar', 'files');
                }
            }
        }
    }
}
