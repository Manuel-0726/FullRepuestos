<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedorSeeder extends Seeder
{
    public function run()
    {
        // Puedes usar un loop para crear 10 proveedores
        for ($i = 1; $i <= 10; $i++) {
            Proveedor::create([
                'nombre' => 'Nombre' . $i,
                'apellido' => 'Apellido' . $i,
                'nombre_empresa' => 'Empresa ' . $i,
                'telefono' => '555-000' . $i,
                'email' => 'proveedor' . $i . '@correo.com',
            ]);
        }
    }
}
