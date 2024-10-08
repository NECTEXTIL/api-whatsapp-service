<?php

namespace App\Cronjos\Persistence;

use App\Utils\Service\NewSql;
use PDO;

class CronjosPersistence
{
    public static function Buscar($id_empresa, $start, $length, $search, $order)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        $params = ['id', 'nombre']; #columnas por las que se realizara la busqueda
        $search = $sql->like_sql_to_string($params, $search);
        return $sql->Exec(function ($con) use ($id_empresa, $start, $length, $search, $order) {
            $table = 'cronjos';
            $columns = 'id,id_empresa,nombre,..';

            $stmt = $con->prepare("CALL SP_SELECT_ALL_EMPRESA(:id_empresa,:start,:length,\"$search\",'$table','$columns','$order')");
            $stmt->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
            $stmt->bindParam("start", $start, PDO::PARAM_INT);
            $stmt->bindParam("length", $length, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        });
    }

    public static function Listar($data)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        return $sql->Exec(function ($con) use ($data) {
            $query = "SELECT w.*,e.wpp_url url,e.wpp_token token FROM 
            whatsapp w
            INNER JOIN empresa e on e.id=w.id_empresa
            WHERE estado='PENDIENTE'";
            $stmt = $con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        });
    }

    public static function Crear()
    {
        $data = '';
        // Ejemplo de uso
        $sql = new NewSql();
        return $sql->Exec(function ($con) use ($data) {

            $query = "INSERT INTO cronjos VALUES ...";
            $stmt = $con->prepare($query);
            $stmt->execute();
            return $con->lastInsertId();
        });
    }

    public static function BuscarPorId($id)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        return $sql->Exec(function ($con) use ($id) {

            $query = "SELECT * FROM cronjos WHERE id=:id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        });
    }

    public static function Actualizar($id, $data)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        return $sql->Exec(function ($con) use ($id, $data) {

            $query = "UPDATE whatsapp SET estado='{$data['estado']}',detalle='{$data['detalle']}'  WHERE id=$id";
            $stmt = $con->prepare($query);
            $stmt->execute();
            return $stmt->rowCount();
        });
    }

    public static function Eliminar($id)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        return $sql->Exec(function ($con) use ($id) {

            $query = "DELETE FROM cronjos WHERE id=:id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        });
    }

    public static function HabilitarDeshabilitar($id, $status)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        return $sql->Exec(function ($con) use ($id, $status) {

            $query = "UPDATE cronjos SET habilitado =$status WHERE id=:id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->rowCount();
        });
    }

    public static function Codigo($id_empresa, $codigo)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        return $sql->Exec(function ($con) use ($id_empresa, $codigo) {

            $query = "SELECT * FROM cronjos WHERE id_empresa=:id_empresa and codigo=:codigo";
            $stmt = $con->prepare($query);
            $stmt->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
            $stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        });
    }
}
