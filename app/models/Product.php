<?php
require_once 'app/models/Core/Table.php';   

class Model_Product extends Model_Core_Table
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
}