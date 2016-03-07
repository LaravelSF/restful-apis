<?php

use App\Subscription;
use Illuminate\Database\Seeder;
use Esensi\Model\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(AppTableSeeder::class);
        //$this->call(ChannelsTableSeeder::class);
        //$this->call(SubscriptionsTableSeeder::class);

        Model::reguard();
    }
}
