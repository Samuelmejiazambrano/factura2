<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class rolSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role1 = Role::create(['name' => 'administrador']);
        $role2 = Role::create(['name' => 'empleado']);
        
         Permission::create(['name' => 'inicio'])->syncRoles([$role1, $role2]);
         
         
         Permission::create(['name' => 'producto.crud.index'])->assignRole($role1);
         Permission::create(['name' => 'producto.crud.create'])->assignRole($role1);
         Permission::create(['name' => 'producto.crud.update'])->assignRole($role1);
         Permission::create(['name' => 'producto.crud.delete'])->assignRole($role1);
         
         Permission::create(['name' => 'cliente.index'])->syncRoles([$role1, $role2]);
         Permission::create(['name' => 'cliente.create'])->syncRoles([$role1, $role2]);
         Permission::create(['name' => 'cliente.update'])->syncRoles([$role1, $role2]);
         Permission::create(['name' => 'cliente.delete'])->syncRoles([$role1, $role2]);
         Permission::create(['name' => 'factura.index'])->syncRoles([$role1, $role2]);
         
         Permission::create(['name' => 'factura.indexCliente'])->syncRoles([$role1, $role2]);
         Permission::create(['name' => 'factura.buscarProductos'])->syncRoles([$role1, $role2]);
         Permission::create(['name' => 'factura.mostrarDetalle'])->syncRoles([$role1, $role2]);
         Permission::create(['name' => 'factura.create'])->syncRoles([$role1, $role2]);
         Permission::create(['name' => 'factura.cliente.indexDetalle'])->syncRoles([$role1, $role2]);
         Permission::create(['name' => 'factura.cliente.pdf'])->syncRoles([$role1, $role2]);
    }
}
