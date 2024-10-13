<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Enums\Type;
use App\Models\Detail_treatment;
use App\Models\Observation;
use App\Models\Person;
use App\Models\Schedule;
use App\Models\Setting;
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

        Schedule::create([
            'day' => 1,
            'start' => '08:00:00',
            'end' => '10:00:00'
        ]);
        Schedule::create([
            'day' => 2,
            'start' => '08:00:00',
            'end' => '10:00:00'
        ]);
        Schedule::create([
            'day' => 3,
            'start' => '08:00:00',
            'end' => '10:00:00'
        ]);
        Schedule::create([
            'day' => 4,
            'start' => '08:00:00',
            'end' => '10:00:00'
        ]);

        $p = Person::create([
            'ci' => 7329034,
            'name' => 'cristian',
            'surname' => 'abalos',
            'birthdate' => '2001-07-09',
            'gender' => 1
        ]);

        User::create([
            'person_id' => $p->id,
            'role' => 1,
            'email' => 'cristianmanuel007@gmail.com',
            'password' => '12345678'
        ]);

        Setting::create([]);

        Person::factory(10)->has(User::factory())->create();
        // User::factory(10)->has(Person::factory(10))->create();
    }
}
