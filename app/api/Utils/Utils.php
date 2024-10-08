<?php

namespace App\Utils;

class Utils
{
    public static function newFolder($path)
    {
        if (!file_exists($path)) {
            if (mkdir($path, 0777, true)) {
                return true;
            }
        } else {
            return true;
        }
        return false;
    }

    /**
     * Y-m-d H:i:s.
     * */
    public static function Now()
    {
        ini_set('date.timezone', 'America/Lima');
        return date('Y-m-d H:i:s', time());
    }

    public static function Time()
    {
        ini_set('date.timezone', 'America/Lima');
        return date('h:i:s');
    }
    /**
     * @param string $zone default 'America/Lima'
     * @param string $format default 'Y-m-d H:i:s'
     *  */
    public static function DateTime($format = 'Y-m-d H:i:s', $zone = 'America/Lima')
    {
        ini_set('date.timezone', $zone);
        return date($format, time());
    }

    public static function responseParamsUpdate($res, $id = null)
    {
        if ($res === 1 || $res === '1') {
            return (object)[
                'id' => (int)$id ?? null,
                'rowCount' => $res,
                'message' => 'Datos guardados.',
                'data' => null,
            ];
        }

        if ($res === 0 || $res === '0') {
            return (object)[
                'id' => (int)$id ?? null,
                'rowCount' => $res,
                'message' => 'Datos guardados sin cambios.',
                'data' => null,
            ];
        }
        return $res;
    }

    public static function  eliminarCarpetaArchivos($carpeta)
    {
        if (is_dir($carpeta)) {
            // Escanea todos los archivos y subdirectorios dentro de la carpeta
            $archivos = scandir($carpeta);

            // Elimina los archivos dentro de la carpeta
            foreach ($archivos as $archivo) {
                if ($archivo != "." && $archivo != "..") {
                    $archivoRuta = $carpeta . DIRECTORY_SEPARATOR . $archivo;

                    if (is_dir($archivoRuta)) {
                        // Si es un directorio, llamamos a la función recursivamente
                        self::eliminarCarpetaArchivos($archivoRuta);
                    } else {
                        // Si es un archivo, lo eliminamos
                        unlink($archivoRuta);
                    }
                }
            }

            // Elimina la carpeta vacía
            rmdir($carpeta);
        }
    }

    public static function convertir_a_booleano($elemento)
    {
        // Convertir los valores de user_create, user_read, user_update y user_delete a booleanos
        $elemento['user_create'] = (bool) $elemento['user_create'];
        $elemento['user_read'] = (bool) $elemento['user_read'];
        $elemento['user_update'] = (bool) $elemento['user_update'];
        $elemento['user_delete'] = (bool) $elemento['user_delete'];
        return $elemento;
    }
}
