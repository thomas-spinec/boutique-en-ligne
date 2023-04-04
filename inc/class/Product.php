<?php
require_once "Model.php";
class Product extends Model{
    protected $bdd;
    protected $tablename = "product";
    
    public function __construct()
    {
            parent::__construct();
    }

    public function getAll($categ=null)
    {
        $request = "SELECT  product.id_product, product.title, product.description, product.image, product.price, product.sales, linkCateg.id_product AS id_link_product, linkCateg.id_categ, category.id_category, category.name FROM $this->tablename  INNER JOIN linkCateg ON product.id_product=linkCateg.id_product INNER JOIN category ON linkCateg.id_categ=category.id_category";

        if ($categ!=null){
            $request = $request . " WHERE category.id_category=$categ";
        }
    }

}   

?>