<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'/libraries/JSON_WebServer_Controller.php');
class Usuario extends JSON_WebServer_Controller {
    public function __construct() {
        parent::__construct();
        
        $this->load->model('srv/tienda_model', 'tienda');        
        
      
        $this->RegisterFunction('Total()', 'Devuelve el número de productos que tenemos en la tienda');
        $this->RegisterFunction('Lista(offset, limit)', 
                'Devuelve una lista de productos de tamaño máximo [limit] comenzando desde la posición desde [offset]');
    }
    /**
     * Devuelve el número total de productos que hay en nuestra tienda
     */
    public function Total()
    {
        return $this->tienda->total();
    }
    
    /**
     * Devolverá la lista de productos que existen en nuestra tienda comenzando por "offset" 
     * y limitado a un número de elementos "limit"
     * @param unknown $offset
     * @param unknown $limit
     */
    public function Lista($offset, $limit)
    {
        return $this->tienda->lista((int)$offset,(int) $limit);
    }    
   
}
