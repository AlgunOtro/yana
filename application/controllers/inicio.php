<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller
{
	/**
	 * Controlador Inicio
	 *
	 * @author Byron Oña
	 */

	function __construct() {
		parent::__construct();
		log_message('debug', 'Clase Controlador Inicio Iniciado');
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->load->library('tank_auth');
		$this->lang->load('form_validation','spanish');
		$this->lang->load('bussing','spanish');
		$this->lang->load('tank_auth','spanish');
		$this->load->model('inicio/permiso_acceso');
		$this->config->load('sigep');
		$this->config->load('inicio');
	}

	/**
	 * Redirecciona a la Pantalla Principal si se ha iniciado sesión,
     * sino redirecciona a la Pantalla de Inicio
     *
     * @return void
     */
	function index()
	{
		if ( ! $this->session->userdata('logged_in'))
		{
			//Crea la sesión
			$this->session->set_userdata(array(
				'logged_in'	=> FALSE,
				'intentos'	=> 1,
				));
			//Redirección a Pantalla de Inicio
			$data["login_form"] = $this->config->item("login_settings");
			$this->load->view('menu/inicio', $data);
		}
		else
		{
			//Redirección a Pantalla Principal
			redirect('inicio/menu');
		}
	}

	/**
	 * Verifica el inicio de sesión, si es correcto se redirecciona a
	 * la Pantalla Principal sino a la Pantalla de Inicio
	 *
	 * @return	void
	 */
	function login()
	{
		if ( !$this->session->userdata('logged_in'))
		{
			//Reglas del formulario
			$this->form_validation->set_rules($this->config->item("login_settings"));
			//Validación del formulario
			if ($this->form_validation->run())
			{
				//Inicio de sesión exitoso
				$this->session->set_userdata(array(
					'logged_in'	=> TRUE,
					'intentos'	=> 0,
					));
				//Redirección a Pantalla Principal
				redirect('inicio/menu');
			}
			else
			{
	        	//Redirección a Pantalla de Inicio
				$data["login_form"] = $this->config->item("login_settings");
				$this->load->view('menu/inicio', $data);
			}
		}
		else
		{
			//Redirección a Pantalla Principal
			redirect('inicio/menu');
		}
	}

	/**
	 * Muestra la Pantalla Principal si se ha iniciado sesión,
	 * sino se redirecciona a la Pantalla de Inicio
	 *
	 * @return	void
	 */
	function menu()
	{
		if ($this->session->userdata('logged_in'))
		{
			$data = array();
			//Obtiene el menú
			$arr_menu = $this->permiso_acceso->obtener_permisos($this->session->userdata('username'));
			$menu['menu'] = $arr_menu;
			$data = array_merge($data,$menu);
			$this->load->view('plantilla/cabecera',$data);
			$this->load->view('plantilla/pie');
		}
		else
		{
			//Redirección a Pantalla de Inicio
			redirect('inicio');
		}
	}

	/**
	 * Cierra la sesión
	 *
	 * @return	void
	 */
	function salir()
	{
		// See http://codeigniter.com/forums/viewreply/662369/ as the reason for the next line
		$this->session->set_userdata(array('user_id' => '', 'username' => '', 'status' => '','logged_in' => FALSE));
		$this->session->sess_destroy();
		unset($_COOKIE['ci_session']);
		redirect('/inicio/');
	}

	/**
	 * Verificar el inicio de sesión mediante Active Directory.
	 *
	 * @param	string
	 * @return	bool
	 */
	function _check_ad($password)
	{
		if ($this->config->item("tiene_directorio_activo"))
		{
			//Datos servidor LDAP
			$host = $this->config->item("ad_host");
			$domain = $this->config->item("ad_domain");
			$subdomain = $this->config->item("ad_subdomain");
			//Limpiar código XSS de campo usuario
			if ($login = $this->input->post('nombre'))
			{
				$login = $this->security->xss_clean($login);
			}
			else
			{
				$login = '';
			}
			//Recuperar datos del formulario
			$user = mb_strtolower($login);
			//Conectar a LDAP
			$ad = ldap_connect("ldap://{$host}.{$domain}{$subdomain}") or die('No se puede conectar al servidor LDAP.');
			//Configurar la versión de protocolo
			ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
			ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);
			//Variables de sesión para controlar intentos fallidos
			if ($this->session->userdata('username') != $user)
			{
				$this->session->set_userdata(array('intentos' => 1));
			}
			$this->session->set_userdata(array('username' => $user));
			//Enlace al servidor
			if (@ldap_bind($ad, "{$domain}\\{$user}", $password))
			{
				//Vinculación exitosa a Active Directory
				if ($res = $this->_limpiar_intentos($user))
				{
					return TRUE;
				}
				else
				{
					return FALSE;
				}
			}
			else
			{
	   			//No se puede vincular a Active Directory
				if ($this->_maxima_cantidad_intentos($user))
				{
					$this->form_validation->set_message('_check_ad', 'Usuario bloqueado.');
				}
				else
				{
					$this->_incrementar_intento($user);
					$num_intentos = $this->_obtener_cantidad_intentos($user);
					$this->session->set_userdata(array('intentos' => $num_intentos));
					$this->form_validation->set_message('_check_ad', 'Usuario o clave inválidos. Intento '.$num_intentos);
				}
				return FALSE;
			}
		}
		else
		{
			if ($this->tank_auth->is_logged_in())									// logged in
			{
				return TRUE;
			}
			$usuario = $this->input->post('nombre');
			$clave = $this->input->post('clave');
			$data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
				$this->config->item('use_username', 'tank_auth'));
			$data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');
			if ($this->tank_auth->login($usuario,$clave,FALSE,$data['login_by_username'],$data['login_by_email']))
			{
				return TRUE;
			}
			else
			{
				$this->form_validation->set_message('_check_ad', 'Usuario o clave inválidos.');
				return FALSE;
			}
		}
	}

	/**
	 * Limpia los intentos fallidos
	 *
	 * @param	string
	 * @return	void
	 */
	function _limpiar_intentos($user)
	{
		$direccion_ip = $this->session->userdata('ip_address');
		$this->load->model('inicio/intentos_acceso');
		return $this->intentos_acceso->limpiar_intentos($direccion_ip,mb_strtolower($user));
	}

	/**
	 * Verifica si se excedió la máxima cantidad
	 * de intentos fallidos
	 *
	 * @param	string
	 * @return	bool
	 */
	function _maxima_cantidad_intentos($user)
	{
		$direccion_ip = $this->session->userdata('ip_address');
		$this->load->model('inicio/intentos_acceso');
		return ($this->intentos_acceso->obtener_cantidad_intentos($direccion_ip,$user) + 1) >= $this->config->item("maximo_intentos_acceso") ;
	}

	/**
	 * Incrementa un intento fallido
	 *
	 * @param	string
	 * @return	bool
	 */
	function _incrementar_intento($user)
	{
		$direccion_ip = $this->session->userdata('ip_address');
		$this->load->model('inicio/intentos_acceso');
		return $this->intentos_acceso->incrementar_intento($direccion_ip,$user);
	}

	/**
	 * Obtiene la cantidad de intentos fallidos
	 *
	 * @param	string
	 * @return	int
	 */
	function _obtener_cantidad_intentos($user)
	{
		$direccion_ip = $this->session->userdata('ip_address');
		$this->load->model('inicio/intentos_acceso');
		return $this->intentos_acceso->obtener_cantidad_intentos($direccion_ip,$user);
	}

	/**
	 * Crea un usuario para la aplicación
	 *
	 * @return	void
	 */
	function _crear_usuario()
	{
		$username = 'admin';
		$email = 'admin@root.org';
		$password = 'toor';
		$email_activation = FALSE;
		var_dump( $this->tank_auth->create_user($username, $email, $password, $email_activation) );
	}
}

/* End of file inicio.php */
/* Location: ./application/controllers/inicio.php */