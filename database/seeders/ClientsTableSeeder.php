<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
            [

                'en' => 'Ahmed',
                'ar' => 'أحمد',

                'en' => 'Mohamed',
                'ar' => 'محمد',

            ],

        ];

        foreach ($clients as $client) {

            Client::create([
                'name' => $client,
                'phone' => '011111112',
                'address' => 'cairo',
            ]);

        } //end of foreach
    }
}
