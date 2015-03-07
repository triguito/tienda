<?php
class productos extends CI_Model 
{
	function ListaDestacado($desde=0,$limite=0)
	{

		$this->AplicaCondicionDestacados();
		$this->db->limit($limite,$desde);
		$query=$this->db->get("producto");
		return $query->result();

	}
	function ListaProducto($id,$desde=0,$limite=0)
	{
		$this->db->where('categoria_id',$id);
		$this->db->limit($limite,$desde);
		$query=$this->db->get("producto");
		return $query->result();
	}
	
	function TotalDestacados()
	{
		$this->AplicaCondicionDestacados();
		return $this->CuentaRegistros();
	}
	
	function TotalCategoria($id)
	{
		$this->db->where('categoria_id',$id);
		return $this->db->count_all_results('producto');
		
	}
	
    
	private function AplicaCondicionDestacados()
	{
		$datestring="%Y-%m-%d %H:%i:%s";
		$time=time();
		$fechaActual=mdate($datestring,$time);
				
		$this->db->where('destacado','1');
		$this->db->where('mostrar','1');
		$this->db->where("fechaIniDest <",$fechaActual);
		$this->db->where("fechaFinDest >",$fechaActual);		
	}
	
	function ListaCategorias()
	{
		//$query = $this->db->select("nombre");
		//$query = $this->db->where('mostrar','1');
		$query = $this->db->get("categoria");

		return $query->result();
	}
	
	 function CuentaRegistros()
	 {
	 	return $this->db->count_all_results('producto');
	 }
	 function AñadeProducto($id)
	 {
	 	$this->db->where('id',$id);
	 	$query=$this->db->get("producto");
	 	return $query->result();
	 }
	 
	
	 
	
}