<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ImagenController extends Controller
{
    public function store(Request $request)
    {
        // Guarda el Archivod de la imagen
        $imagen = $request->file('file');

        // Genera el nombre único
        $nombreImagen = Str::uuid() . '.' . $imagen->extension();

        // Crea la imagen con intervention image
        $imagenServidor = Image::make($imagen);

        // Recorta la imagen
        $imagenServidor->fit(1000, 1000);

        // Path de la imagen
        $imagenPath = public_path('uploads') . '/' . $nombreImagen;

        // Guarda la imagen en el servidor
        $imagenServidor->save($imagenPath);

        return response()->json(['imagen' => $nombreImagen]);
    }
}
