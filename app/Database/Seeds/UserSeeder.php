<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
	public function run()
	{
		$data = [ 
		    'name' => 'superuser',
		    'email' => 'superuser@mail.test',
		    'password' => password_hash('password', PASSWORD_BCRYPT),
		    'email_verified_at' => date('Y-m-d H:i:s'),
		    'remember_token' => rand(),
			'created_at' => date("Y-m-d H:i:s")
	    ];
	    
	    $this->db->table('users')
	        ->insert($data);
	    
	    $this->db->table('role_user')
	        ->insert([
	            'role_id' => 1,
	            'user_id' => 1
	       ]);
	}
}
