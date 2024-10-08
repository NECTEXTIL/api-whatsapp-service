<?php
namespace Mnt\mantenedores\Email\Persistence;

use App\Utils\Service\NewSql;
use PDO;

class EmailPersistence
{
    public static function Buscar($id_empresa, $start, $length, $search, $order)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        $params = ['id','nombre']; #columnas por las que se realizara la busqueda
        $search = $sql->like_sql_to_string($params, $search);
        return $sql->Exec(function ($con) use ($id_empresa, $start, $length, $search, $order){
            $table = 'email';
            $columns = 'id,id_empresa,nombre,..';

            $stmt = $con->prepare("CALL SP_SELECT_ALL_EMPRESA(:id_empresa,:start,:length,\"$search\",'$table','$columns','$order')");
            $stmt->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
            $stmt->bindParam("start", $start, PDO::PARAM_INT);
            $stmt->bindParam("length", $length, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        });
    }

    public static function Listar($id_empresa, $start, $length, $search, $order)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        return $sql->Exec(function ($con) use ($id_empresa, $start, $length, $search, $order){
            $query = "SELECT * FROM email WHERE id_empresa=:id_empresa";
            $stmt = $con->prepare($query);
            $stmt->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        });
    }

    public static function Crear($body, $id_empresa)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        return $sql->Exec(function ($con) use ($body, $id_empresa) {

            $json = json_encode($body);

            $sql = "CALL SP_EMAIL_I(:json)";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':json', $json, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        });
    }

    public static function BuscarPorId($id)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        return $sql->Exec(function ($con) use ($id) {

            $query = "SELECT * FROM email WHERE id=:id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        });
    }

    public static function Actualizar($id, $body)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        return $sql->Exec(function ($con) use ($id, $body) {

            $query = "UPDATE email SET ...  WHERE id=$id";
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

            $query = "DELETE FROM email WHERE id=:id";
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

            $query = "UPDATE email SET habilitado =$status WHERE id=:id";
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

            $query = "SELECT * FROM email WHERE id_empresa=:id_empresa and codigo=:codigo";
            $stmt = $con->prepare($query);
            $stmt->bindParam(":id_empresa", $id_empresa, PDO::PARAM_INT);
            $stmt->bindParam(":codigo", $codigo, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        });
    }
}
