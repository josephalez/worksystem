<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EstadosSeeder::class);
        //$this->call(OfficesTableSeeder::class);
        $this->call(OrganizationsSeederTable::class);
        $this->call(PeopleTableSeeder::class);
        $this->call(MembersTableSeeder::class);
        $this->call(ProjectsTableSeeder::class);
        //$this->call(AssistancesTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        $this->call(PhasesTableSeeder::class);
        $this->call(StagesTableSeeder::class);
    }
}
