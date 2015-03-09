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
			$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/log_ok','',true);
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
			$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/mod_usu',array('usuarios'=>$this->usuarios->DatosUsuario($this->session->userdata("username")),
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
			$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/mod_ok','',true);
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
			$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/cambiapass','',true);
			$this->load->view("plantilla",$this->datos_plantilla);
		}
		else
		{
			$datos=Array(
					'contraseña'=>$this->input->post('pass1'));
			$this->usuarios->CambiaPass($datos,$this->input->post('pass'));
			
			$this->mostrarPlantilla();
			$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/cambiapass_ok','',true);
			$this->load->view("plantilla",$this->datos_plantilla);
				
		}
		
	}
	public function RestauraPass()
	{
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_CompruebaMail');
		if ($this->form_validation->run() == FALSE)
		{
			$this->mostrarPlantilla();
			$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/RestauraPass','',true);
			$this->load->view("plantilla",$this->datos_plantilla);
		}
		else 
		{
			$this->load->library('email');
			$this->load->helper('security');
			
			$config['protocol'] = 'smtp';
			$config['smtp_host'] = 'mail.iessansebastian.com';
			$config['smtp_user'] = 'aula4@iessansebastian.com';
			$config['smtp_pass'] = 'daw2alumno';
			
			$this->email->initialize($config);
	
			
			$cuerpo=rand(10000,9999999);
			$cifrada=do_hash($cuerpo,'md5');
			$datos=Array('contraseña'=>$cifrada);
			
			$this->usuarios->CambiaPassConEmail($datos,$this->input->post('email'));
			
			$this->EnviaCorreo($this->input->post('email'),$cuerpo);	
		
		}
	}
	private function EnviaCorreo($destino,$cuerpo)
	{
		$this->email->from('aula4@iessansebastian.com', 'Restaurar Contraseña');
		$this->email->to($destino);
		$this->email->subject('Restaurar Contraseña Tienda');
		$this->email->message('La contraseña es '.$cuerpo);
	
		if ( $this->email->send() )
		{
			$this->mostrarPlantilla();
			$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/restaurarpass_ok','',true);
			$this->load->view("plantilla",$this->datos_plantilla);
		}
		else
		{
			$this->mostrarPlantilla();
			$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/restaurapass_fail','',true);
			$this->load->view("plantilla",$this->datos_plantilla);
		}
	
		//echo $this->email->print_debugger();
	}
		
	public function CompruebaMail($email)
	{
		if($this->usuarios->DevuelveEmail($email)==1)
		{
			return true;
		}
		else
		{
			$this->form_validation->set_message('CompruebaMail', 'Email Incorrecto');
			return false;
		}
		
	}
	function Listapedidos()
	{
		$this->mostrarPlantilla();
		$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/listapedidos',array('pedidos'=>$this->usuarios->ListaPedidos()),true);
		$this->load->view("plantilla",$this->datos_plantilla);
	}
	function CancelarPedido($cod)
	{
		$this->usuarios->CancelarPedido($cod);
		$this->mostrarPlantilla();
		$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/listapedidos',array('pedidos'=>$this->usuarios->ListaPedidos()),true);
		$this->load->view("plantilla",$this->datos_plantilla);
		
	}
	function RealizarPedido()
	{
		$this->load->helper('date');
		$bandera=false;
		if($this->cart->total()=='0')
		{
			redirect(site_url("/login/CarroVacio"));
		}
		else
		{
		$datestring = "%Y-%m-%d %h:%i:%s";
		$time = time();
		$fecactual=mdate($datestring, $time);
		
		$fecha= new DateTime($fecactual);
		$entrega=$fecha->add(new DateInterval("P14D"));
		
		$usuario=$this->usuarios->DatosUsuario($this->session->userdata("username"));
		
		$datos=Array(
					'codPedido'=>$cuerpo=rand(10000,9999999),
					'fechaPedido'=>$fecactual,
					'fechaEntrega'=>$entrega->format("Y-m-d"),
					'estado'=>'p',
					'cantidadDisponible'=>'10',
					'nombreUsu'=>$usuario[0]->nombre,
					'apellidoUsu'=>$usuario[0]->apellido,
					'dniUsu'=>$usuario[0]->dni,
					'direccionUsu'=>$usuario[0]->direccion,
					'cpUsu'=>$usuario[0]->cp,
					'provinciaUsu'=>$usuario[0]->provincia_cod,
					'usuario_id'=>$usuario[0]->id
					);
		$this->usuarios->RealizarPedido($datos);
		
		redirect("/login/LineaPedido");
		}
		
		
	}
	function LineaPedido()
	{
		$idPedido= $this->usuarios->CodUltimoPedido();
		$productos=$this->cart->contents();
		
		foreach ($productos as $producto)
		{
			$datos=Array(
					'producto_id'=>$producto['id'],
					'pedido_id'=>$idPedido[0]->id,
					'cantidad'=>$producto['qty'],
					'PrecioVenta'=>$producto['subtotal'],
			);
			$this->usuarios->AddLineaPedido($datos);
		}
		$this->carrito->destroy();
		redirect("/login/Listapedidos");
		
	}
	function VerLineaPedido($codPedido)
	{
		$LineaPedido=$this->usuarios->VerLineaPedido($codPedido);

		$productos=$this->productos->VerProduco($LineaPedido[0]->producto_id);
		
		$this->mostrarPlantilla();
		$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/lineapedido',array('LineaPedidos'=>$LineaPedido,
																						'productos'=>$productos),true);
		$this->load->view("plantilla",$this->datos_plantilla);
	}
	function CarroVacio()
	{
		$this->mostrarPlantilla();
		$this->datos_plantilla["cuerpo"]= $this->load->view('cuerpos/CarroVacio',"",true);
		$this->load->view("plantilla",$this->datos_plantilla);
	}
	
}