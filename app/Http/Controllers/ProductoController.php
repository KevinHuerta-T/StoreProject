<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index(Request $request)
{
    $productos = Producto::orderBy('nombre');

    // Aplicar filtros de búsqueda
    if ($request->has('buscar')) {
        $buscar = $request->input('buscar');
        $productos = $productos->where('nombre', 'LIKE', "%$buscar%")
                               ->orWhere('descripcion', 'LIKE', "%$buscar%");
    }

    // Aplicar filtro de precio mínimo
    if ($request->has('precio_min')) {
        $precio_min = $request->input('precio_min');
        $productos = $productos->where('precio', '>=', $precio_min);
    }

    // Aplicar filtro de precio máximo
    if ($request->has('precio_max')) {
        $precio_max = $request->input('precio_max');
        $productos = $productos->where('precio', '<=', $precio_max);
    }

    $productos = $productos->simplePaginate(10);

    return view('productos.index', compact('productos'));
}

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $producto = new Producto;
        $producto->fill($request->all());
        $producto->save();

        return redirect()->route('productos.index');
    }

    public function destroy($id)
{
    // Obtener el producto por ID
    $producto = Producto::findOrFail($id);

    // Eliminar el producto
    $producto->delete();

    // Redirigir al usuario a la lista de productos con un mensaje de éxito
    return redirect()->route('productos.index')->with('success', 'El producto ha sido eliminado.');
}

public function edit($id)
{
    // Obtener el producto por ID
    $producto = Producto::findOrFail($id);

    // Mostrar la vista de edición con el producto correspondiente
    return view('productos.edit', ['producto' => $producto]);
}
public function update(Request $request, $id)
{
    // Obtener el producto por ID
    $producto = Producto::findOrFail($id);

    // Actualizar los datos del producto
    $producto->nombre = $request->input('nombre');
    $producto->descripcion = $request->input('descripcion');
    $producto->precio = $request->input('precio');
    $producto->save();

    // Redirigir al usuario a la lista de productos con un mensaje de éxito
    return redirect()->route('productos.index')->with('success', 'El producto ha sido actualizado.');
}
}
