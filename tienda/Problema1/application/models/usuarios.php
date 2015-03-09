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
	function DevuelveEmail($email)
	{
		$this->db->where('email', $email);
		$query=$this->db->get("usuario");
		return $query->num_rows();
	}
	function CambiaPassConEmail($datos,$email)
	{
		$this->db->where('email', $email);
		$this->db->update('usuario', $datos);
	}
	function codUsu()
	{
		$this->db->select("id");
		$this->db->where('nombreUsu',$this->session->userdata("username"));
		$query=$this->db->get("usuario");
		return $query->result();
	}
	function ListaPedidos()
	{
		$codUsu=$this->codUsu();
		
		$this->db->where("usuario_id",$codUsu[0]->id);
		$query=$this->db->get("pedido");
		return $query->result();
	}
	function CancelarPedido($cod)
	{
		$datos=Array('estado'=>'a');
		$this->db->where('id', $cod);
		$this->db->update('pedido', $datos);
	}
	function RealizarPedido($datos)
	{
		$this->db->insert('pedido', $datos);
	}
	function CodUltimoPedido()
	{
		$this->db->select_max('id');
		$query = $this->db->get('pedido');
		return $query->result();
	}
	function AddLineaPedido($datos)
	{
		$this->db->insert('lineapedido', $datos);
	}
	function VerLineaPedido($codpedido)
	{
		$this->db->where('pedido_id',$codpedido);
		$query = $this->db->get('lineapedido');
		return $query->result();
	}
}
