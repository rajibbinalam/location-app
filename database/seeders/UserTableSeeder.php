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
            ['id' =>  '1', 'name' => 'Mizan',      'driver_name' => 'Mizan',       'email' => 'mizan@gmail.com',        'phone' => 12345678,     'route_no' => '4', 'bus_no' => '39'],
        ];
    }
}
