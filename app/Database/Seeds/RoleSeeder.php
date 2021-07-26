<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use function config;

class RoleSeeder extends Seeder
{
	public function run()
	{
		$data = [
			[
			  'name' => config('Defender')->superuser_role ?? 'superuser',
			  'created_at' => date("Y-m-d H:i:s")
		  ],
			[
			  'name' => 'admin',
			  'created_at' => date("Y-m-d H:i:s")
		  ],
			[
			  'name' => 'noaccess',
			  'created_at' => date("Y-m-d H:i:s")
		  ]
		];

		$this->db->table('roles')->insertBatch($data);
	}
}
