<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\ProductoMoto;
use App\Models\Lubricante;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Procesa la consulta de búsqueda unificada.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function results(Request $request)
    {
        $query = $request->input('query');

        // Búsqueda en el modelo de productos de carro
        $productosCarro = Producto::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('descripcion', 'LIKE', "%{$query}%")
            ->get();

        // Búsqueda en el modelo de productos de moto
        $productosMoto = ProductoMoto::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('descripcion', 'LIKE', "%{$query}%")
            ->get();

        // Búsqueda en el modelo de lubricantes
        $lubricantes = Lubricante::where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('descripcion', 'LIKE', "%{$query}%")
            ->get();

        // Combina todas las colecciones en una sola
        $productos = $productosCarro->merge($productosMoto)->merge($lubricantes);

        return view('search_results', compact('productos', 'query'));
    }
}
