<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Popusa',
            'phone' => '2225243028',
            'email' => 'popusa@gmail.com',
            'profile' => 'ADMIN',
            'status' => 'ACTIVE',
            'password' => bcrypt('22324598')
        ]);
        User::create([
            'name' => 'Juan Luna',
            'phone' => '2225243028',
            'email' => 'jjuanv03@gmail.com',
            'profile' => 'EMPLOYEE',
            'status' => 'ACTIVE',
            'password' => bcrypt('99887766')
        ]);

        // crear role Administrador
        $admin    = Role::create(['name' => 'ADMIN']);

        //Crear los permisos componente de almacenes
        Permission::create(['name' => 'Almacenes_Create']);
        Permission::create(['name' => 'Almacenes_Search']);
        Permission::create(['name' => 'Almacenes_Update']);
        Permission::create(['name' => 'Almacenes_Destroy']);

        //Crear los permisos de las zonas
        Permission::create(['name' => 'Zonas_Create']);
        Permission::create(['name' => 'Zonas_Search']);
        Permission::create(['name' => 'Zonas_Update']);
        Permission::create(['name' => 'Zonas_Destroy']);

        //Crear los permisos de las usuarios-conteos
        Permission::create(['name' => 'UsuariosConteos_Create']);
        Permission::create(['name' => 'UsuariosConteos_Search']);
        Permission::create(['name' => 'UsuariosConteos_Update']);
        Permission::create(['name' => 'UsuariosConteos_Destroy']);

        //Crear los permisos componente de inventarios
        Permission::create(['name' => 'Inventarios_Create']);
        Permission::create(['name' => 'Inventarios_Search']);
        Permission::create(['name' => 'Inventarios_Update']);
        Permission::create(['name' => 'Inventarios_Destroy']);

        //Crear los permisos componente de productos o alta csv
        Permission::create(['name' => 'Productos_Create']);
        Permission::create(['name' => 'Productos_Search']);

        //Crear los permisos componente de masivo o alta csv
        Permission::create(['name' => 'Existencias_Create']);
        Permission::create(['name' => 'Existencias_Search']);
        
        //Crear los permisos componente de masivo o alta csv
        Permission::create(['name' => 'Presentaciones_Create']);
        Permission::create(['name' => 'Presentaciones_Search']);

        //Crear los permisos componente de masivo o alta csv
        Permission::create(['name' => 'Conteo_Create']);
        Permission::create(['name' => 'Conteo_Search']);
        Permission::create(['name' => 'Conteo_Update']);
        Permission::create(['name' => 'Conteo_Destroy']);

        
        // asignar permisos al rol Admin sobre las diferentes vistas
        $admin->givePermissionTo(['Productos_Create', 'Productos_Search', 'Almacenes_Create','Almacenes_Search','Almacenes_Update','Almacenes_Destroy','Zonas_Create','Zonas_Search','Zonas_Update','Zonas_Destroy',
    'UsuariosConteos_Create','UsuariosConteos_Search','UsuariosConteos_Update','UsuariosConteos_Destroy','Inventarios_Create', 'Inventarios_Search', 'Inventarios_Update', 'Inventarios_Destroy', 'Existencias_Create', 'Existencias_Search', 'Presentaciones_Create', 'Presentaciones_Search', 'Conteo_Create', 'Conteo_Search', 'Conteo_Update', 'Conteo_Destroy']);

        // asignar role Admin al usuario Juan Luna
        $uAdmin = User::find(1);
        $uAdmin->assignRole('ADMIN');
    }
}
