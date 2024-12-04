<?php

class Articulo{
    
    public $id_articulo;
    public $descripcion;
    public $precio;
    public $stock;
    public $id_categoria;
    public $categoria;

    public $DB;
    public $lasterror;
    public $numrows;

    public function __construct($CNX, $id_articulo = 0){

        $this->id_articulo = $id_articulo;
        $this->DB = $CNX;

        if($id_articulo > 0){
            $this->load();
        }
    }

    private function load(){

        $query = "SELECT a.id_articulo,
                         a.descripcion,
                         a.precio,
                         a.stock,
                         a.id_categoria,
                         c.descripcion as categoria
                  FROM   articulos a
                         INNER JOIN categorias c ON
                         a.id_categoria = c.id_categoria
                  WHERE  a.id_articulo = ?";

        try{

            $stmt = $this->DB->prepare($query);

            $stmt->execute(array($this->id_articulo));

            $rows = $stmt->fetchAll();

            if(!$rows){
                $this->numrows = 0;
                $this->lasterror = "El artículo con id: $this->id_articulo no existe en la base de datos";
                return;
            }

            $row = $rows[0];

            $this->descripcion  = $row['descripcion'];
            $this->precio       = $row['precio'];
            $this->stock        = $row['stock'];
            $this->id_categoria = $row['id_categoria'];
            $this->categoria    = $row['categoria'];

            $this->numrows      = 1;



        }catch(Exception $e){

            $this->lasterror = $e->getMessage();

        }

    }

    private function insert(){

        $query = "INSERT into articulos (descripcion,
                                         precio,
                                         stock,
                                         id_categoria)
                                values(  ?,
                                         ?,
                                         ?,
                                         ?)";
        try{

            $stmt = $this->DB->prepare($query);

            $stmt->execute(array($this->descripcion,
                                 $this->precio,
                                 $this->stock,
                                 $this->id_categoria)
                    );

            $this->id_articulo = $this->DB->lastInsertId();
            $this->numrows     = 1;
            return true;
            
        }catch(Exception $e){

            $this->lasterror = $e->getMessage();
            $this->numrows   = 0;
            return false;

        }

    }

    private function update(){

        $query = "UPDATE articulos set descripcion  = ?,
                                       precio       = ?,
                                       stock        = ?,
                                       id_categoria = ?
                  WHERE id_articulo = ?";
        try{

            $stmt = $this->DB->prepare($query);

            $stmt->execute(array($this->descripcion,
                             $this->precio,
                             $this->stock,
                             $this->id_categoria,
                             $this->id_articulo)
                    );
            $this->numrows   = 1;
            return true;

        }catch(Exception $e){

            $this->lasterror = $e->getMessage();
            $this->numrows   = 0;
            return false;
        }
        
    }

    public function save(){
        if( empty($this->id_articulo) ){
            return $this->insert();
        }else{
            return $this->update();
        }
    }

    public function toJSON(){

        $arr = array("id_articulo"  => $this->id_articulo,
                     "descripcion"  => $this->descripcion,
                     "precio"       => $this->precio,
                     "stock"        => $this->stock,
                     "id_categoria" => $this->id_categoria,
                     "categoria"    => $this->categoria);

        return json_encode($arr);

    }

    public static function getAll($CNX){

        $query = "SELECT    a.id_articulo,
                            a.descripcion,
                            a.precio,
                            a.stock,
                            a.id_categoria,
                            c.descripcion as categoria
                    FROM    articulos a
                            INNER JOIN categorias c ON
                            a.id_categoria = c.id_categoria
                    ORDER BY a.descripcion";

        try {

            $stmt = $CNX->query($query);

            $rows = $stmt->fetchAll();

            return $rows;


        } catch (Exception $e) {

            return $e->getMessage();

        }
    }
}

if(isset($_GET['id_articulo']) && is_numeric($_GET['id_articulo'])){

        include("../config/db_con.php");

        $art = new Articulo($CNX,$_GET['id_articulo']);
        header('Content-Type: application/json; charset=utf-8');
        echo $art->toJSON();


}