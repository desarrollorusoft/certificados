<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Response;

class ZipController extends Controller
{
    public function generarLink(Request $request) {

        DB::beginTransaction();
        try {

            $documentos = $request->documentos;
            Log::debug("documentos: ". json_encode($documentos));

            /* Creo el directorio raiz donde voy a poner los archivos temporales */
            $folderName =  rand(1,99999);
            Storage::makeDirectory(public_path('storage/temp/'.$folderName));

            foreach ($documentos as $documento) {

                $exists = Storage::disk('public')->exists($documento['path']);
                if ($exists) {

                    $infoPath = pathinfo(public_path($documento['path']));
                    $extension = $infoPath['extension'];
                    $copiado = Storage::disk('public')->exists('storage/temp/' . $folderName . '/' . $documento['tipo'] . '/' . $documento['codigo'] . '/' . $documento['titulo'] . '.' . $extension);
                    if (!$copiado) {
                        Storage::disk('public')->copy($documento['path'], 'storage/temp/' . $folderName . '/' . $documento['tipo'] . '/' . $documento['codigo'] . '/' . $documento['titulo'] . '.' . $extension);
                    }

                }

            }

            $FileZipName = 'doc' . rand(1,9999999);
            $dir = 'storage/zips/' . $FileZipName . '.zip';
            $url = url('/') . '/'. $dir;
            $zip = new \Chumper\Zipper\Zipper;
            $files = glob('storage/temp/'.$folderName);
            $zip = $zip->make(public_path($dir));
            $zip->add($files)->close();

            Log::debug("file temp: ".public_path('storage/temp/'.$folderName));
            Storage::disk('public')->deleteDirectory('storage/temp/'.$folderName);

          DB::commit();



        } catch (Exception $e) {

            DB::rollback();
            throw $e;

        }
        Log::debug("url: ". $url);
        return $url;

    }
    use Chumper\Zipper\Zipper;

    public function generarYDescargarZip()
    {
        DB::beginTransaction();
        Log::debug("Este es el zip, entró a la parte superior del generador: " . date("F j, Y, g:i a"));

        try {
            $documentos = DB::select('CALL getDocumentosZip');
            $zipFileName = 'general.zip';
            $zipFilePath = public_path('storage/zips/' . $zipFileName);

            $zip = new Zipper;

            if ($zip->make($zipFilePath)->exists()) {
                $zip->remove($zipFileName);
            }

            foreach ($documentos as $documento) {
                $tipo = $documento->tipo;
                $codigo = $documento->codigo;
                $nombreArchivo = $documento->nombre_archivo;
                $path = public_path($documento->path);
                $extension = pathinfo($path, PATHINFO_EXTENSION);

                $zip->folder($tipo . '/' . $codigo)->add($path, $nombreArchivo . '.' . $extension);
            }

            DB::commit();
            Log::debug("Archivo ZIP creado y almacenado correctamente.");

            return Response::download($zipFilePath, $zipFileName);
        } catch (Exception $e) {
            DB::rollback();
            Log::error("Error: " . $e);
            throw $e;
        }
    }

}
