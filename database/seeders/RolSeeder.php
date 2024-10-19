<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

use Spatie\Permission\Model\Role;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name'=>'Administrador'
        ]);
        Role::create([
            'name'=>'Agente'
        ]);
        Role::create([
            'name'=>'Usuario'
        ]);
        Role::create([
            'name'=>'Administrador de Activo'
        ]);

        Permission::create([
            'name'=>'issue_types.index'
        ]);

        Permission::create([
            'name'=>'issue_types.store',
        ]);

        Permission::create([
            'name'=>'issue_types.update',
        ]);
    }
}
