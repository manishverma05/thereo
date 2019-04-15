<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        $this->call(RolesDefaultSeeder::class);
        $this->call(DefaultAdminUserSeeder::class);

        #fakers
        $this->call(FakeAuthorUsersSeeder::class);
        $this->call(FakeMaterialSeeder::class);
        $this->call(FakeProgramCategorySeeder::class);
        $this->call(FakeResourceSeeder::class);
        $this->call(FakeSessionCategorySeeder::class);
        $this->call(FakeSessionSeeder::class);
    }

}
