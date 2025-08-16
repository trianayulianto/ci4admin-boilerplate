<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PermissionSeeder extends Seeder
{
	public function run()
	{
		$permissions = [
			'system' => [
				'activity' => [
					'index'  => "Can read user's activity logs",
					'delete' => "Can delete user's activity logs"
				]
			],
			'account' => [
				'users' => [
					'index'  => 'Can read users data',
					'create' => 'Can create users data',
					'update' => 'Can update users data',
					'delete' => 'Can delete users data',
					'assign' => "Can assign user's role & permission"
				],
			],
			'access' => [
				'roles' => [
					'index'  => 'Can read roles data',
					'create' => 'Can create roles data',
					'update' => 'Can update roles data',
					'delete' => 'Can delete roles data',
					'assign' => "Can assign role's permission"
				],
				'permissions' => [
					'index'  => 'Can read permissions data',
					'create' => 'Can create permissions data',
					'update' => 'Can update permissions data',
					'delete' => 'Can delete permissions data'
				],
			],
			'main' => [
				// when the menu doesn't have group insert it into here
				// for example the dashboard menu bellow
				'dashboard' => [
					'index' => 'Can see dashboard page'
				]
			]
		];

		$data = [];
		foreach ($permissions as $group => $groups) {
			foreach ($groups as $menu => $menus) {
				foreach ($menus as $index => $value) {
					$data[] = [
						'name' 			=> $group.'.'.$menu.'.'.$index,
						'readable_name' => $value,
			      'created_at' => date("Y-m-d H:i:s")
					];
				}
			}
		}

		$this->db->table('permissions')->insertBatch($data);
	}
}
