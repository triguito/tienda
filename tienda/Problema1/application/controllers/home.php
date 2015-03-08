<?php
class home extends CI_Controller 
{
	
	const NELEMENTOxPAGINA=2;
	
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('productos');
		$this->load->library('carrito');
	}
	
	public function index($desde=0)
	{
		$this->form_validation->set_rules('cantidad', 'Cantidad', 'numeric');
		$this->form_validation->set_rules('id', 'Id', 'numeric');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->cargaDestacados($desde);
			$this->mostrarPlantilla($desde);
		}
		else
		{
			$this->AddACarrito();
		}
		
	}

	private function cargaDestacados($desde)
	{
		/* Load the 'pagination' library */
		
		//CSS del Paginador
		
		
		$opciones['base_url'] = base_url('index.php/home/index');
		$opciones['per_page'] =self::NELEMENTOxPAGINA;
		$opciones['total_rows'] = $this->productos->TotalDestacados();	/* Load the 'pagination' library */
		
		$this->pagination->initialize($opciones);
		
		$this->datos_plantilla["cuerpo"] = $this->load->view('cuerpos/cuerpo', array(
					'paginador'=>$this->pagination->create_links(),
					'productos'=>$this->productos->ListaDestacado($desde,self::NELEMENTOxPAGINA)
		),true );
		
	}
	
	public function Categoria($categoria_id, $desde=0)
	{
		$this->cargaCategoria($categoria_id, $desde);
		$this->mostrarPlantilla($desde);		
	}
	
	public function CargaCategoria($categoria_id, $desde)
	{
		/* Load the 'pagination' library */
		$this->load->library('pagination');
		
		$opciones['base_url'] = base_url('index.php/home/categoria/'.$categoria_id);
		$opciones['per_page'] =self::NELEMENTOxPAGINA;
		$opciones['total_rows'] = $this->productos->TotalCategoria($categoria_id);
		$opciones['uri_segment'] = 4;
		
		$this->pagination->initialize($opciones);
		
		$this->datos_plantilla["cuerpo"] = $this->load->view('cuerpos/cuerpo', array(
				'paginador'=>$this->pagination->create_links(),
				'productos'=>$this->productos->ListaProducto($categoria_id, $desde,self::NELEMENTOxPAGINA)
		),true );		
	}
	
	public function mostrarPlantilla()
	{
		$this->datos_plantilla["cabecera"] = $this->load->view('/cabeceras/cabecera','' , true);
		$this->datos_plantilla["menu"] = $this->load->view('/menus/menu',array('categorias'=>$this->productos->ListaCategorias()) , true);
		$this->datos_plantilla["pie"] = $this->load->view('/pies/pie',NULL,true);
		$this->load->view("plantilla",$this->datos_plantilla);
	}
	
	public function AddACarrito()
	{
		$this->load->library('carrito');
		
		$productos=$this->productos->AñadeProducto($this->input->post("id"));
		
		
		$producto = array(
				'id'      => $productos[0]->id,
				'qty'     => $this->input->post('cantidad'),
				'price'   => $productos[0]->PrecioVenta,
				'name'    => $productos[0]->nombre,
				'options' => array('imagen'=>$productos[0]->Imagen)
				//'options' => array('Size' => 'L', 'Color' => 'Red')
		);
		
		$this->carrito->insert($producto);
		redirect(site_url("/home/verCarrito"));
	}
	
	public function VerCarrito()
	{	
		//$this->cart->contents();
	
		$this->datos_plantilla["cuerpo"] = $this->load->view('cuerpos/cuerpocarrito',array('carrito'=>$this->cart->contents()),true );
		$this->mostrarPlantilla();
		//$this->load->view("plantilla",$this->datos_plantilla);	
	}
	
	public function EmilinarCompra()
	{
		$this->carrito->destroy();
		redirect(site_url("/home/verCarrito"));
	}
	
	public function EliminaProducto($id)
	{
		$producto = array(
				'rowid' => $id,
				'qty'   => 0
		);
		$this->carrito->update($producto);
		redirect(site_url("/home/VerCarrito"));
		
	}
	

	
	
}