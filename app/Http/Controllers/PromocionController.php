<?php

namespace App\Http\Controllers;

use App\Models\Promocion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PromocionController extends Controller
{
    public function index()
    {
        $promociones = Promocion::with('promoinsta')->where('activo', 1)->orderBy('id', 'desc')->get();
        $vista = view('dashboard.partials.promociones', compact('promociones'))->render();

        return response()->json(['view' => $vista], 200);
    }

    public function limpiar()
    {
        if (isset(auth()->user()->type) and auth()->user()->type == 'admin') {
            $promos = Promocion::get();

            if (isset($promos[0])) {
                foreach ($promos as $promo) {
                    if (isset($promo->id)) {
                        // Eliminar todas las imágenes
                        $this->deleteAllImages($promo);
                        $promo->delete();
                    }
                }
            }
        }

        if (request()->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('dashboard');
    }

    public function create(Request $request)
    {
        $tienda = $request->tienda;

        $promo = new Promocion();
        $promo->descrip = "Debe actualizar este titulo";
        $promo->tienda = $tienda;
        $promo->save();

        return redirect()->route('dashboard', ['tienda' => $tienda]);
    }

    public function store(Request $request)
    {
        $sugeridos = $request->sugeridos;
        $last = 0;
        $sugeridos = json_decode($sugeridos);

        if (isset($sugeridos[0])) {
            foreach ($sugeridos as $sug) {
                $last = $sug->id;
                $sugerido = Promocion::find($last);

                if (!isset($sugerido->id)) {
                    $sugerido = new Promocion();
                }

                $sugerido->id = $sug->id;
                $sugerido->monto = $sug->monto;
                $sugerido->descrip = $sug->nombre;
                $sugerido->codprod = $sug->codprod;
                $sugerido->save();
            }
        }

        return response()->json(['success' => 'success', 'updated' => 1], 200);
    }

    public function eliminar(Request $request)
    {
        $sugeridos = $request->sugeridos;
        $last = 0;
        $sugeridos = json_decode($sugeridos);

        try {
            if (isset($sugeridos[0])) {
                foreach ($sugeridos as $sug) {
                    $last = $sug->id;
                    $promo = Promocion::find($last);

                    if (isset($promo->id)) {
                        $this->deleteAllImages($promo);
                        $promo->delete();
                    }
                }
            }
            return response()->json(['success' => 'success', 'updated' => 1], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'error'], 304);
        }
    }

    /**
     * Subir y comprimir imagen para el home usando Intervention Image
     */
    public function imagenhome(Request $request, $id)
    {
        $allowed = ['gif', 'png', 'jpg', 'jpeg', 'bmp', 'webp'];
        $status = 200;
        $success = 'success';

        $promo = Promocion::find($id);
        if (!$promo) {
            return response()->json(['error' => 'Promoción no encontrada'], 404);
        }

        // Crear instancia de ImageManager
        $manager = new ImageManager(new Driver());

        foreach ($request->files as $file) {
            $name = $file->getClientOriginalName();
            $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));

            if (in_array($ext, $allowed)) {
                // Eliminar imagen anterior si existe
                if ($promo->imagen_home) {
                    $this->deleteHomeImage($promo->imagen_home);
                }

                $rand = rand(0, 1000);
                $newName = 'primghom-' . time() . '-' . $rand . '_' . $id . '.' . $ext;
                $uploadPath = public_path('/img/promociones/');
                $filePath = $uploadPath . $newName;

                // Mover el archivo original
                $file->move($uploadPath, $newName);

                try {
                    // Leer la imagen
                    $image = $manager->read($filePath);

                    // Redimensionar para el home (870x500)
                    $image->cover(870, 500);
                    $image->save($filePath, 80);

                    // Guardar en la base de datos
                    $promo->imagen_home = $newName;
                    $promo->save();

                    $success = 'success';

                } catch (\Exception $e) {
                    // Si falla, eliminar el archivo subido
                    if (file_exists($filePath)) {
                        @unlink($filePath);
                    }
                    return response()->json([
                        'error' => 'Error al procesar la imagen: ' . $e->getMessage()
                    ], 500);
                }

            } else {
                return response()->json([
                    'error' => 'Formato de imagen no permitido. Use: ' . implode(', ', $allowed)
                ], 300);
            }
        }

        $view = view('dashboard.partials.promo_imagen_home', compact('promo'))->render();
        return response()->json([
            $success => $success,
            'status' => $status,
            'view' => $view
        ], $status);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $promo = Promocion::find($id);

        if (!$promo) {
            return response()->json(['error' => 'Promoción no encontrada'], 404);
        }

        $field = $request->n;
        $value = $request->v;

        // Manejar campos especiales
        if ($field == 'destacada') {
            $promo->destacada_at = Carbon::now();
        }

        $promo->$field = $value;
        $promo->pendiente = 0;
        $promo->save();

        return response()->json(['success' => true]);
    }

    public function open(Request $request, $id)
    {
        $promo = Promocion::find($id);

        if (!$promo) {
            return response()->json(['error' => 'Promoción no encontrada'], 404);
        }

        return view('dashboard.partials.promo_edit', compact('promo'))->render();
    }

    public function promoid(Request $request)
    {
        $id = $request->id;
        $promo = Promocion::find($id);
        $vista = '';

        if (isset($promo)) {
            $vista = view('dashboard.partials.promoid', compact('promo'))->render();
        }

        return $vista;
    }

    /**
     * Eliminar una promoción completa
     */
    public function delete(Request $request)
    {
        $id = $request->id;
        $promo = Promocion::find($id);

        if (isset($promo->id)) {
            $this->deleteAllImages($promo);
            $promo->delete();
        }

        return response()->json(['success' => 'success'], 200);
    }

    /**
     * Eliminar solo la imagen principal
     */
    public function destroyimagen($id)
    {
        $promo = Promocion::find($id);

        if (isset($promo->id)) {
            if ($promo->imagen) {
                $this->deleteImageFiles($promo->imagen);
                $promo->imagen = '';
                $promo->save();
            }
        }

        return response()->json(['success' => 'success'], 200);
    }

    /**
     * Eliminar solo la imagen del home
     */
    public function destroyimagenhome($id)
    {
        $promo = Promocion::find($id);

        if (isset($promo->id)) {
            if ($promo->imagen_home) {
                $this->deleteHomeImage($promo->imagen_home);
                $promo->imagen_home = '';
                $promo->save();
            }
        }

        return response()->json(['success' => 'success'], 200);
    }

    /**
     * Eliminar todos los archivos de imagen de una promoción
     */
    private function deleteAllImages($promo)
    {
        // Eliminar imagen principal y sus versiones
        if ($promo->imagen) {
            $this->deleteImageFiles($promo->imagen);
        }

        // Eliminar imagen del home
        if ($promo->imagen_home) {
            $this->deleteHomeImage($promo->imagen_home);
        }
    }

    /**
     * Eliminar todos los archivos relacionados con una imagen principal
     */
    private function deleteImageFiles($imageName)
    {
        $basePath = public_path('/img/promociones/');
        $files = [
            $basePath . $imageName,
            $basePath . 'th' . $imageName,
            $basePath . 'ogc' . $imageName,
        ];

        foreach ($files as $file) {
            if (file_exists($file)) {
                @unlink($file);
                \Log::info('Imagen eliminada: ' . $file);
            }
        }
    }

    /**
     * Eliminar la imagen del home
     */
    private function deleteHomeImage($imageName)
    {
        $filePath = public_path('/img/promociones/' . $imageName);
        if (file_exists($filePath)) {
            @unlink($filePath);
            \Log::info('Imagen home eliminada: ' . $filePath);
        }
    }

    /**
     * Comprimir una imagen existente (útil para migración)
     */
    public function compressExistingImages()
    {
        if (!isset(auth()->user()->type) or auth()->user()->type != 'admin') {
            return response()->json(['error' => 'No autorizado'], 403);
        }

        $promos = Promocion::whereNotNull('imagen')->get();
        $compressed = 0;
        $errors = [];

        $manager = new ImageManager(new Driver());

        foreach ($promos as $promo) {
            try {
                $basePath = public_path('/img/promociones/');
                $imagePath = $basePath . $promo->imagen;

                if (file_exists($imagePath)) {
                    // Comprimir imagen principal
                    $image = $manager->read($imagePath);
                    $image->save($imagePath, 75);

                    // Comprimir thumbnail
                    $thumbPath = $basePath . 'th' . $promo->imagen;
                    if (file_exists($thumbPath)) {
                        $thumb = $manager->read($thumbPath);
                        $thumb->save($thumbPath, 85);
                    }

                    // Comprimir grid
                    $gridPath = $basePath . 'ogc' . $promo->imagen;
                    if (file_exists($gridPath)) {
                        $grid = $manager->read($gridPath);
                        $grid->save($gridPath, 80);
                    }

                    $compressed++;
                }

                // Comprimir imagen home
                if ($promo->imagen_home) {
                    $homePath = $basePath . $promo->imagen_home;
                    if (file_exists($homePath)) {
                        $home = $manager->read($homePath);
                        $home->save($homePath, 80);
                    }
                }

            } catch (\Exception $e) {
                $errors[] = 'Error en promo ' . $promo->id . ': ' . $e->getMessage();
            }
        }

        return response()->json([
            'success' => true,
            'compressed' => $compressed,
            'errors' => $errors
        ]);
    }
}
