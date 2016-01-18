<?php 
defined('BASEPATH') or exit('Error!');
class Ldap extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		//$this->db->query("truncate px_tmp");
		$host = "192.168.8.232"; 
		$user = "ldapuser"; 
		$pswd = "CIFILdapuserRead"; 
		echo "test";
		$ad = ldap_connect($host) or die( "Could not connect!" ); 
		//var_dump($ad);
		if($ad){ 
			//璁剧疆鍙傛暟 
			ldap_set_option ( $ad, LDAP_OPT_PROTOCOL_VERSION, 3 ); 
			ldap_set_option ( $ad, LDAP_OPT_REFERRALS, 0 ); // bool ldap_bind ( resource $link_identifier [, string $bind_rdn = NULL [, string $bind_password = NULL ]] ) 
			$bd = ldap_bind($ad, $user, $pswd) or die ("Could not bind"); 
			
			$attrs = array("displayname","name","sAMAccountName","userPrincipalName","objectclass"); //鎸囧畾闇�鏌ヨ鐨勭敤鎴疯寖鍥� 
			$filter = "(objectclass=*)"; //ldap_search ( resource $link_identifier , string $base_dn , string $filter [, array $attributes [, int $attrsonly [, int $sizelimit [, int $timelimit [, int $deref ]]]]] ) 
			$search = ldap_search($ad, 'ou=旭辉集团股份有限公司,DC=cifi,DC=com,DC=cn', $filter, $attrs,0,0,0) or die ("ldap search failed"); 
			$entries = ldap_get_entries($ad, $search); 
		//		var_dump($entries);

			$data = array();
			if ($entries["count"] > 0) { 
				echo json_encode($entries);
			} else { 
				//echo "<p>No results found!</p>"; 
			} 
		}else{ //echo "Unable to connect to AD server"; 
		} 
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */