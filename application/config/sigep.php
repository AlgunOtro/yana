<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Login settings
|
| 'login_count_attempts' = Count failed login attempts.
| 'maximo_intentos_acceso' = Number of failed login attempts before CAPTCHA will be shown.
| 'login_attempt_expire' = Time to live for every attempt to login. Default is 24 hours (60*60*24).
|--------------------------------------------------------------------------
*/
$config['maximo_intentos_acceso'] = 4;

/*
|--------------------------------------------------------------------------
| Directorio Activo
|--------------------------------------------------------------------------
|
| Permite elegir si para iniciar sesión se utilizará el Directorio Activo
| Para configurar el Directorio Activo
|
*/
$config['tiene_directorio_activo'] = FALSE;
$config['ad_host'] = 'host';
$config['ad_domain'] = 'dominio';
$config['ad_subdomain'] = '.com';

/* End of file sigep.php */
/* Location: ./application/config/sigep.php */