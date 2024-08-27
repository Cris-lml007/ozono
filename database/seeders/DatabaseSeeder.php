<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Enums\Type;
use App\Models\Detail_treatment;
use App\Models\Observation;
use App\Models\Person;
use App\Models\Treatment;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        //
        User::create([
            'role' => Role::ADMIN,
            'email' => 'admin@ozono.com',
            'password' => '12345678'
        ]);

        $t=Treatment::create([
            'name' => 'masaje',
            'description' => 'masaje a cuerpo',
            'price' => 220
        ]);
        $tt=Treatment::create([
            'name' => 'masaje A',
            'description' => 'masaje a cuerpo A',
            'price' => 120
        ]);

        $o=Observation::create([
            'name' => 'embarazo',
            'type' => Type::CONTRAIN
        ]);
        $o=Observation::create([
            'name' => 'mareos',
            'type' => Type::EFFECT
        ]);

        Detail_treatment::create([
            'treatment_id' => $t->id,
            'observation_id' => $o->id
        ]);
        Detail_treatment::create([
            'treatment_id' => $tt->id,
            'observation_id' => $o->id
        ]);

        Person::factory(10)->has(User::factory())->create();
        // User::factory(10)->has(Person::factory(10))->create();
    }
}
