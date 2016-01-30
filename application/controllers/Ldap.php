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

	 public function __construct()
    {
        # code...
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('Tools');
         $this->load->database();
    }
	public function ldap()
	{
		set_time_limit(0);
		//$this->db->query("truncate px_tmp");
		$host = "192.168.5.3"; 
		$user = "zldcgroup\zldc"; 
		$pswd = "zldc@8888"; 
		
		$ad = ldap_connect($host) or die( "Could not connect!" ); 
		//var_dump($ad);
		if($ad){ 
			//璁剧疆鍙傛暟 
			ldap_set_option ( $ad, LDAP_OPT_PROTOCOL_VERSION, 3 ); 
			ldap_set_option ( $ad, LDAP_OPT_REFERRALS, 0 ); // bool ldap_bind ( resource $link_identifier [, string $bind_rdn = NULL [, string $bind_password = NULL ]] ) 
			$bd = ldap_bind($ad, $user, $pswd) or die ("Could not bind"); 
			
			$attrs = array("displayname","name","sAMAccountName","userPrincipalName","objectclass"); //鎸囧畾闇�鏌ヨ鐨勭敤鎴疯寖鍥� 
			$filter = "(objectclass=*)"; //ldap_search ( resource $link_identifier , string $base_dn , string $filter [, array $attributes [, int $attrsonly [, int $sizelimit [, int $timelimit [, int $deref ]]]]] ) 
			$search = ldap_search($ad, 'ou=中梁集团,DC=zldcgroup,DC=com', $filter, $attrs,0,0,0) or die ("ldap search failed"); 
			$entries = ldap_get_entries($ad, $search); 
			//echo json_encode($entries);
		//		var_dump($entries);

			$data = array();
			if ($entries["count"] > 0) { 
				//echo '返回记录数：'.$entries["count"]; 
				for ($i=0; $i<$entries["count"]; $i++) { //所要获取的字段，都必须小写 
					//if(isset($entries[$i]["displayname"])){ 
//						echo "<p>name: ".$entries[$i]["name"][0]."<br />";//用户名 
//						echo "<p>sAMAccountName: ".@$entries[$i]["samaccountname"][0]."<br />";//用户名 
						if(isset($entries[$i]["dn"][0])){ 
//							echo "dn: ".$entries[$i]["dn"]."<br />";//用户名字 
							$is_user = in_array('user',$entries[$i]["objectclass"]) ? 1:0; 
							if($is_user == 0) continue;
							$dn = $entries[$i]["dn"];
							$dn = explode(",",$dn);
							
							$area = array();
							foreach($dn as $v){
								if(strpos($v,'OU=') !== false){
									$area[] = str_replace("OU=","",$v);//有的抬头不是OU
								}
							}

							$area = array_reverse($area);
//							var_dump($area);
							list($f1,$f2) = $area;
							$insertArr = array(
								'F1'=>$f1,
								'F2'=>$f2,
								
								
								'FISUSER'=>1,
								'FNUMBER'=>@$entries[$i]["samaccountname"][0],
								'FNAME'=>@$entries[$i]["name"][0],
								'FORG' => 'test',
								);
							
       						
        					$tableName = 'T_USER';
        					
        					$result = $this->Tools->addData($insertArr,$tableName);
        					echo json_encode($result);
    						}

				} 
					//} 
				 
			} else { 
				//echo "<p>No results found!</p>"; 
			} 
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */