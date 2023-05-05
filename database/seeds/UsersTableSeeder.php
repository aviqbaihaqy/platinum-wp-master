<?php

use Illuminate\Database\Seeder;

use App\User;
use App\UserDetail;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new User([
        	'email' => 'admin@platinumwp.co.id', 
	        'password' => bcrypt('admin'),
	        'role' => 'admin',
        ]);
        $admin->save();

        $adminDetails = new UserDetail([
        	'user_id' => $admin->id,
        
	        'first_name' => 'Administrator',
	        'last_name' => 'Platinum WP',
	        'address' => 'Ruko Peterongan Plaza, Jl. MT. Haryono Blok D-7, Wonodri, Semarang Selatan',
	        'city' => 'Semarang',
	        'postal_code' => '50242',
	        'phone' => '000-0000-000',
	        'country_code' => 'IDN',
        ]);
        $adminDetails->save();

        $staff = new User([
            'email' => 'staff@platinumwp.co.id', 
            'password' => bcrypt('staff'),
            'role' => 'staff',
        ]);
        $staff->save();

        $staffDetails = new UserDetail([
            'user_id' => $staff->id,
        
            'first_name' => 'Staff',
            'last_name' => 'Platinum WP',
            'address' => 'Ruko Peterongan Plaza, Jl. MT. Haryono Blok D-7, Wonodri, Semarang Selatan',
            'city' => 'Semarang',
            'postal_code' => '50242',
            'phone' => '000-0000-000',
            'country_code' => 'IDN',
        ]);
        $staffDetails->save();

        $user = new User([
        	'email' => 'user@platinumwp.co.id', 
	        'password' => bcrypt('user'),
	        'role' => 'user',
        ]);
        $user->save();

        $userDetails = new UserDetail([
        	'user_id' => $user->id,
        
	        'first_name' => 'User',
	        'last_name' => 'Platinum WP',
	        'address' => 'Ruko Peterongan Plaza, Jl. MT. Haryono Blok D-7, Wonodri, Semarang Selatan',
	        'city' => 'Semarang',
	        'postal_code' => '50242',
	        'phone' => '000-0000-000',
	        'country_code' => 'IDN',
        ]);
        $userDetails->save();
    }
}
