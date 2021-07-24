<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use function config;

class RoleSeeder extends Seeder
{
	public function run()
	{
		$data = [
			['name' => config('Defender')->superuser_role ?? 'superuser'],
			['name' => 'admin'],
			['name' => 'noaccess']
		];

		$this->db->table('roles')->insertBatch($data);
	}
}
