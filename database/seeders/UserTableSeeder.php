<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getUsers() as $key => $value) {
            User::firstOrCreate([
                'id'                => $value['id']
            ],[
                'name'              => $value['name'],
                'email'             => $value['email'],
                'phone'             => $value['phone'],
                'driver_name'       => $value['driver_name'],
                'route_no'          => $value['route_no'],
                'bus_no'            => $value['bus_no'],
                'email_verified_at' => today(),
                'password'          => Hash::make($value['phone']),
            ]);
        }
    }


    private function getUsers()
    {
        return [
            ['id' =>  1, 'name' => 'Mizan',                 'driver_name' => 'Mizan',               'email' => 'mizan@gmail.com',           'phone' => '12345678',          'route_no' => 4,    'bus_no' => 39],
            ['id' =>  2, 'name' => 'Anik',                  'driver_name' => 'Anik',                'email' => 'anik@gmail.com',            'phone' => '017677',            'route_no' => 5,    'bus_no' => 40],
            ['id' =>  3, 'name' => 'Hasan Ali',             'driver_name' => 'Hasan Ali',           'email' => 'hasan@gmail.com',           'phone' => '0171841',           'route_no' => 6,    'bus_no' => 41],
        ];
    }
}
