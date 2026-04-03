<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $super1 = new User();

        $super1->id = 1;
        $super1->name = "Carlos Ramirez";
        $super1->email = "sistemascarlosramirez@gmail.com";
        $super1->password = '$2y$12$PLAnpM8IybS32ZHBHZVl9.Oo78jPxjkf09NX.Evjm718d8a.oKElK';
        $super1->created_at = "2023-02-02 01:13:24";
        $super1->updated_at = "2023-02-02 01:13:24";

        $super1->save();

        $super2 = new User();

        $super2->id = 2;
        $super2->name = "Juana Valentina";
        $super2->email = "juanitadiaz2828@gmail.com";
        $super2->password = '$2y$12$ccUCCGJTcI4gKof1FENdE.PhmPkpSWuS5E1FhDBWXD3QNSeJkYbCe';
        $super2->created_at = "2023-02-02 01:13:24";
        $super2->updated_at = "2023-02-02 01:13:24";

        $super2->save();







        //************************************* */







        //************************************* */

        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        //************************************* */
    }
}
