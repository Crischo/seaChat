<?php
include_once('../controladores/Controlador_Base.php');
include_once('../entidades/CRUD/DestinoRecursosEstudiante.php');
class Controlador_destinorecursosestudiante extends Controlador_Base
{
   function crear($args)
   {
      $destinorecursosestudiante = new DestinoRecursosEstudiante($args["id"],$args["descripcion"]);
      $sql = "INSERT INTO DestinoRecursosEstudiante (descripcion) VALUES (?);";
      $parametros = array($destinorecursosestudiante->descripcion);
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      if(is_null($respuesta[0])){
         return true;
      }else{
         return false;
      }
   }

   function actualizar($args)
   {
      $destinorecursosestudiante = new DestinoRecursosEstudiante($args["id"],$args["descripcion"]);
      $parametros = array($destinorecursosestudiante->descripcion,$destinorecursosestudiante->id);
      $sql = "UPDATE DestinoRecursosEstudiante SET descripcion = ? WHERE id = ?;";
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      if(is_null($respuesta[0])){
         return true;
      }else{
         return false;
      }
   }

   function borrar($args)
   {
      $id = $args["id"];
      $parametros = array($id);
      $sql = "DELETE FROM DestinoRecursosEstudiante WHERE id = ?;";
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      if(is_null($respuesta[0])){
         return true;
      }else{
         return false;
      }
   }

   function leer($args)
   {
      $id = $args["id"];
      if ($id==""){
         $sql = "SELECT * FROM DestinoRecursosEstudiante;";
      }else{
      $parametros = array($id);
         $sql = "SELECT * FROM DestinoRecursosEstudiante WHERE id = ?;";
      }
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }

   function leer_paginado($args)
   {
      $pagina = $args["pagina"];
      $registrosPorPagina = $args["registros_por_pagina"];
      $desde = (($pagina-1)*$registrosPorPagina);
      $sql ="SELECT * FROM DestinoRecursosEstudiante LIMIT $desde,$registrosPorPagina;";
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }

   function numero_paginas($args)
   {
      $registrosPorPagina = $args["registros_por_pagina"];
      $sql ="SELECT IF(ceil(count(*)/$registrosPorPagina)>0,ceil(count(*)/$registrosPorPagina),1) as 'paginas' FROM DestinoRecursosEstudiante;";
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta[0];
   }

   function leer_filtrado($args)
   {
      $nombreColumna = $args["columna"];
      $tipoFiltro = $args["tipo_filtro"];
      $filtro = $args["filtro"];
      switch ($tipoFiltro){
         case "coincide":
            $parametros = array($filtro);
            $sql = "SELECT * FROM DestinoRecursosEstudiante WHERE $nombreColumna = ?;";
            break;
         case "inicia":
            $sql = "SELECT * FROM DestinoRecursosEstudiante WHERE $nombreColumna LIKE '$filtro%';";
            break;
         case "termina":
            $sql = "SELECT * FROM DestinoRecursosEstudiante WHERE $nombreColumna LIKE '%$filtro';";
            break;
         default:
            $sql = "SELECT * FROM DestinoRecursosEstudiante WHERE $nombreColumna LIKE '%$filtro%';";
            break;
      }
      $respuesta = $this->conexion->ejecutarConsulta($sql,$parametros);
      return $respuesta;
   }
}