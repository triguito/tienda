<?php

class Tienda_model extends CI_Model
{
    /**
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function total()
    {
        $consulta = 'SELECT COUNT(*) as filas FROM producto	WHERE cantidad > 1;
					';
        $totalfilas = $this->db->query($consulta)->row()->filas;
        
        return $totalfilas;
    }
    public function lista($offset, $limit)
    {
        $lista = array();
        
        $this->db->where('cantidad >',"1");
        $query = $this->db->get('producto', $limit, $offset);
        $listaProductos = $query->result_array();
        
        $base=site_url(base_url("/img"));
        
        foreach ($listaProductos as $key => $item) {
            $lista[$key]['nombre'] = $item['nombre'];
            $lista[$key]['img'] = $item[$base.'Imagen'];
            $lista[$key]['descripcion'] = $item['descripcion'];
            $lista[$key]['precio'] = $item['PrecioVenta'];
            $lista[$key]['url'] = site_url('home/index/');
        }
        return $lista;
    }
}
