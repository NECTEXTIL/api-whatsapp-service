<?php

namespace Mnt\mantenedores\Usuario\Persistence;

use App\Utils\Service\NewSql;
use PDO;

class UsuarioPersistence
{
    public static function Buscar($start, $length, $search, $order, $id_empresa)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        $params = ['id', 'nombres', 'apellidos', 'email', 'username']; #columnas por las que se realizara la busqueda
        $search = $sql->like_sql_to_string($params, $search);
        return $sql->Exec(function ($con) use ($start, $length, $search,$order, $id_empresa) {
            $table = 'usuario';
            $columns = 'id,id_empresa,nombres,apellidos,email,username,habilitado';

            $stmt = $con->prepare("CALL SP_SELECT_ALL_EMPRESA(:id_empresa,:start,:length,\"$search\",'$table','$columns','$order')");
            $stmt->bindParam("id_empresa", $id_empresa, PDO::PARAM_INT);
            $stmt->bindParam("start", $start, PDO::PARAM_INT);
            $stmt->bindParam("length", $length, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        });
    }

    public static function Listar($Ctx, $start, $length, $search, $order)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        return $sql->Exec(function ($con) use ($Ctx, $start, $length, $search, $order) {

            $where= $Ctx->id===1|| $Ctx->id==2? "": " WHERE u.id_empresa='{$Ctx->id_empresa}'";
            $query = "SELECT u.*,e.numero_documento,e.razon_social FROM usuario u
                     INNER JOIN empresa_nucleo e ON e.id=u.id_empresa
                    $where;";
                    //WHERE id_empresa=:id_empresa";
            $stmt = $con->prepare($query);
            //$stmt->bindParam(":id_empresa", $Ctx->id_empresa, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        });
    }

    public static function Crear($body, $id_empresa)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        return $sql->Exec(function ($con) use ($body, $id_empresa) {

            $query = "INSERT INTO usuario
            (id_empresa,nombres,apellidos,email,username,password,telefono,photo,fecha_creacion,habilitado,id_rol)
            VALUES(:id_empresa,:nombres,:apellidos,:email,:username,:password,:telefono,:photo,:fecha_creacion,:habilitado,:id_rol)";
            $stmt = $con->prepare($query);

            $stmt->bindParam(":id_empresa", $body["id_empresa"], PDO::PARAM_INT);
            $stmt->bindParam(":nombres", $body["nombres"], PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $body["apellidos"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $body["email"], PDO::PARAM_STR);
            $stmt->bindParam(":username", $body["username"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $body["password"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $body["telefono"], PDO::PARAM_STR);
            $stmt->bindParam(":photo", $body["photo"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_creacion", $body["fecha_creacion"], PDO::PARAM_STR);
            $stmt->bindParam(":habilitado", $body["habilitado"], PDO::PARAM_INT);
            $stmt->bindParam(":id_rol", $body["id_rol"], PDO::PARAM_INT);

            $stmt->execute();
            return $con->lastInsertId();
        });
    }

    public static function BuscarPorId($id)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        return $sql->Exec(function ($con) use ($id) {

            $query = "SELECT * FROM usuario WHERE id=$id";
            $stmt = $con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        });
    }

    public static function Actualizar($id, $body)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        return $sql->Exec(function ($con) use ($id, $body) {

            $query = "UPDATE usuario SET
                id_empresa = :id_empresa,
                nombres = :nombres,
                apellidos = :apellidos,
                email = :email,
                username = :username,
                password = :password,
                telefono = :telefono,
                photo =:photo,
                habilitado =:habilitado,
                id_rol =:id_rol
                WHERE id=:id";
            $stmt = $con->prepare($query);
            $stmt->bindParam(":id_empresa", $body["id_empresa"], PDO::PARAM_INT);
            $stmt->bindParam(":nombres", $body["nombres"], PDO::PARAM_STR);
            $stmt->bindParam(":apellidos", $body["apellidos"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $body["email"], PDO::PARAM_STR);
            $stmt->bindParam(":username", $body["username"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $body["password"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $body["telefono"], PDO::PARAM_STR);
            $stmt->bindParam(":photo", $body["photo"], PDO::PARAM_STR);
            $stmt->bindParam(":habilitado", $body["habilitado"], PDO::PARAM_INT);
            $stmt->bindParam(":id_rol", $body["id_rol"], PDO::PARAM_INT);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            $stmt->execute();
            return $stmt->rowCount();
        });
    }

    public static function Eliminar($id)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        return $sql->Exec(function ($con) use ($id) {

            $query = "DELETE FROM usuario WHERE id=$id";
            $stmt = $con->prepare($query);
            $stmt->execute();
            return $stmt->rowCount();
        });
    }

    public static function HabilitarDeshabilitar($id, $status)
    {
        // Ejemplo de uso
        $sql = new NewSql();
        return $sql->Exec(function ($con) use ($id, $status) {

            $query = "UPDATE usuario SET habilitado =$status WHERE id=$id";
            $stmt = $con->prepare($query);
            $stmt->execute();
            return $stmt->rowCount();
        });
    }
}
