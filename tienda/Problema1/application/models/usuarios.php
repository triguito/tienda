<?php
class usuarios extends CI_Model 
{ 
	
	function ListaProvincia()
	{
		$query=$this->db->get("provincia");
		return $query->result();
	}
	
	function AddUser($usu)
	{
		$this->db->insert('usuario', $usu);
	}
	function Verusu($usu=0)
	{
		$this->db->where('nombreUsu', $usu);
		$query=$this->db->get("usuario");
		return count($query->result_array());
	}
	
	function ExisteUsuario($usu)
	{
		$this->db->where('nombreUsu', $usu);
		$query=$this->db->get("usuario");
		return $query->num_rows();
	}
	
	function CompruebaLogin($usu,$pass)
	{
		$this->db->where('nombreUsu',$usu);
		$this->db->where('contraseña',$pass);
		$this->db->where('baja',0);
		$query=$this->db->get("usuario");
		return $query->num_rows();
	}
	function DarBaja($usu)
	{
		$data = array(
				'baja' => 1,
		);
		$this->db->where('nombreUsu',$usu);
		$this->db->update('usuario', $data);
		
	}
	function DatosUsuario($usu)
	{
		$this->db->where('nombreUsu',$usu);
		$query=$this->db->get("usuario");
		return $query->result();
	}
	function ProvinciaUsuario($cod)
	{
		$this->db->where("cod",$cod);
		$query=$this->db->get('provincia');
		return $query->result();
		
	}
	function ModificaUsu($datos,$usu)
	{
		$this->db->where('nombreUsu', $usu);
		$this->db->update('usuario', $datos);
	}
	function DevuelvePass($pass)
	{
		$this->db->where('contraseña', $pass);
		$query=$this->db->get("usuario");
		return $query->num_rows();
	}
	function CambiaPass($datos,$pass)
	{
		$this->db->where('contraseña', $pass);
		$this->db->update('usuario', $datos);
	}
}
