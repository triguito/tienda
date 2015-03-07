<?php
class login extends CI_Controller 
{
	
	const NELEMENTOxPAGINA=2;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('carrito');
		$this->load->model('usuarios');
		$this->load->model('productos');
	}
	
	public function index()
	{
		$this->mostrarPlantilla();
		$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/login','',true);
		$this->load->view("plantilla",$this->datos_plantilla);
	}
	
	public function formNuevo_usuario()
	{
		
		$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|min_length[4]|xss_clean|callback_usuario_ok');
		$this->form_validation->set_rules('pass', 'Password', 'required|matches[pass2]|md5');
		$this->form_validation->set_rules('pass2', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|alpha|min_length[4]|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('dni', 'dni', 'required|callback_validarDNI');
		$this->form_validation->set_rules('direccion', 'direccion', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('cp', 'codigo postal', 'trim|required|min_length[5]|numeric|xss_clean');
		$this->form_validation->set_rules('provincia', 'Provincia', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
				
			$this->mostrarPlantilla();
			$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/formUsu',array('provincias'=>$this->usuarios->ListaProvincia()),true);
			$this->load->view("plantilla",$this->datos_plantilla);
		}
		else
		{
				
			$usuarios=Array(
					'nombreUsu'=>$this->input->post('usuario'),
					'contraseña'=>$this->input->post('pass'),
					'email'=>$this->input->post('email'),
					'nombre'=>$this->input->post('nombre'),
					'apellido'=>$this->input->post('apellidos'),
					'dni'=>$this->input->post('dni'),
					'direccion'=>$this->input->post('direccion'),
					'cp'=>$this->input->post('cp'),
					'provincia_cod'=>$this->input->post('provincia'));
				
				
			$this->usuarios->AddUser($usuarios);
			$this->mostrarPlantilla();
			$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/log_Ok','',true);
			$this->load->view("plantilla",$this->datos_plantilla);
				
				
		}
	}
	
	public function validarDNI($str)
	{
		$this->form_validation->set_message('validarDNI', 'Dni incorrecto');
		$str = trim($str);
		$str = str_replace("-","",$str);
		$str = str_ireplace(" ","",$str);
	
		if ( !preg_match("/^[0-9]{7,8}[a-zA-Z]{1}$/" , $str) )
		{
			return FALSE;
		}
		else
		{
			$n = substr($str, 0 , -1);
			$letter = substr($str,-1);
			$letter2 = substr ("TRWAGMYFPDXBNJZSQVHLCKE", $n%23, 1);
			if(strtolower($letter) != strtolower($letter2))
				return FALSE;
		}
		return TRUE;
	}
	public function mostrarPlantilla()
	{
		$this->datos_plantilla["cabecera"] = $this->load->view('/cabeceras/cabecera','' , true);
		$this->datos_plantilla["menu"] = $this->load->view('/menus/menu',array('categorias'=>$this->productos->ListaCategorias()) , true);
		$this->datos_plantilla["pie"] = $this->load->view('/pies/pie',NULL,true);
		
	}
	/**
	 * para que no se registre con un nombre de usuario ya registrado
	 * @param unknown $usuario
	 * @return boolean
	 */
	public function usuario_ok($usuario)
	{
		if ($usuario==$this->session->userdata("username"))
		{
			return true;
		}
		else 
		{
			$this->form_validation->set_message('usuario_ok', 'Usuario ocupado');
			if($this->usuarios->Verusu($usuario)!=0)
			{
				return false;
			}
			return true;
		}
	}
	
	/**
	 * Comprueba que el usuario existe
	 * @param unknown $usuario
	 * @return boolean
	 */
	public function CompruebaLogin($pass)
	{
		
		
		$existe=$this->usuarios->CompruebaLogin($this->input->post('user'),$pass);
		if ($existe)
		{
			return TRUE;
		}
		else 
		{
			$this->form_validation->set_message('CompruebaLogin', 'Usuario/Contraseña incorrecto');
			return FALSE;
		}
	}
	
	
	public function Entrar()
	{
		//$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|min_length[4]|xss_clean|callback_usuario_ok');
		$this->form_validation->set_rules('user', 'Usuario', 'required|');
		//$this->form_validation->set_rules('user', 'Usuario', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|md5|callback_CompruebaLogin');
		if ($this->form_validation->run() == FALSE)
		{
			$this->mostrarPlantilla();
			$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/login','',true);
			$this->load->view("plantilla",$this->datos_plantilla);
		}
		else 
		{
			$sesion=array();
			$this->session->set_userdata('logueado',true);
			$this->session->set_userdata('username',$this->input->post('user'));
			redirect(site_url("home/VerCarrito"));
		}
		
	}
	public function Salir()
	{
		$this->session->sess_destroy();
		redirect(site_url('home/index'));
	}
	public function Perfil()
	{
		$this->mostrarPlantilla();
		$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/perfil','',true);
		$this->load->view("plantilla",$this->datos_plantilla);
	}
	public function Baja()
	{
		$this->usuarios->DarBaja($this->session->userdata('username'));
		$this->session->sess_destroy();
		redirect(site_url("home/index"));
		
	}
	public function Modificar()
	{
		$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|min_length[4]|xss_clean|callback_usuario_ok');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|alpha|min_length[4]|xss_clean');
		$this->form_validation->set_rules('apellidos', 'Apellidos', 'required|min_length[5]|xss_clean');
		$this->form_validation->set_rules('dni', 'dni', 'required|callback_validarDNI');
		$this->form_validation->set_rules('direccion', 'direccion', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('cp', 'codigo postal', 'trim|required|min_length[5]|numeric|xss_clean');
		$this->form_validation->set_rules('provincia', 'Provincia', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$cod_provincia=$this->usuarios->DatosUsuario($this->input->post('usuario'));
			
			$cod_provincia=$this->usuarios->ProvinciaUsuario($cod_provincia[0]->provincia_cod);

			$this->mostrarPlantilla();
			$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/Mod_Usu',array('usuarios'=>$this->usuarios->DatosUsuario($this->input->post('usuario')),
																						'provincias'=>$this->usuarios->ListaProvincia(),
																						'provinciasUsus'=>$cod_provincia
																						),true);
			$this->load->view("plantilla",$this->datos_plantilla);
		}
		else
		{
			$datos=Array(
					'nombreUsu'=>$this->input->post('usuario'),
					'email'=>$this->input->post('email'),
					'nombre'=>$this->input->post('nombre'),
					'apellido'=>$this->input->post('apellidos'),
					'dni'=>$this->input->post('dni'),
					'direccion'=>$this->input->post('direccion'),
					'cp'=>$this->input->post('cp'),
					'provincia_cod'=>$this->input->post('provincia'));
			
			$this->usuarios->ModificaUsu($datos,$this->session->userdata('username'));
			
			$this->session->set_userdata("username",$this->input->post('usuario'));
			$this->mostrarPlantilla();
			$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/Mod_Ok','',true);
			$this->load->view("plantilla",$this->datos_plantilla);
			
			
		}
	}
	public function CompruebaPass($pass)
	{
		if($this->usuarios->DevuelvePass($pass)==1)
		{
			return true;
		}
		else 
		{
			$this->form_validation->set_message('CompruebaPass', 'Contraseña antigua erronea');
			return false;
		}
	}
	public function CambiarPass()
	{
		$this->form_validation->set_rules('pass', 'Password', 'required|md5|callback_CompruebaPass');
		$this->form_validation->set_rules('pass1', 'Password', 'required|matches[pass2]|md5');
		$this->form_validation->set_rules('pass2', 'Password Confirmation', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->mostrarPlantilla();
			$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/CambiaPass','',true);
			$this->load->view("plantilla",$this->datos_plantilla);
		}
		else
		{
			$datos=Array(
					'contraseña'=>$this->input->post('pass1'));
			$this->usuarios->CambiaPass($datos,$this->input->post('pass'));
			
			$this->mostrarPlantilla();
			$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/CambiaPass_Ok','',true);
			$this->load->view("plantilla",$this->datos_plantilla);
				
		}
		
	}
	
}