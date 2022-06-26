<?php

	defined('BASEPATH') or exit('No direct script access allowed');

	class Index extends CI_Controller
	{	
		public function __construct()
		{
			parent::__construct();

			$this->data["header"] = $this->load->view('style/header', '', true);
			$this->data["sidebar"] = $this->load->view('style/sidebar', '', true);
			$this->data["footer"] = $this->load->view('style/footer', '', true);
			$this->data["js"] = $this->load->view('style/js', '', true);
			$this->data["navbar"] = $this->load->view('style/navbar', '', true);

			if(!$this->session->userdata('idagent'))
			{
				$this->session->sess_destroy();
				redirect('login/index');
			}
		}  
		public function index()
		{ 
			$this->load->view('index', $this->data);
		}
		public function accueil()
		{
			$this->load->view('index', $this->data);
		}
		
		public function achat()
		{
			$this->db->join('devise', 'taux.iddevise = devise.iddevise');
			$this->db->where('intitule', 'CDF');
			$this->data["taux"] = $this->db->get("taux")->result_array();
			
			$this->db->join('compte', 'compte.idclient = client.idclient');
			$this->db->join('devise', 'devise.iddevise = compte.iddevise');
			$this->db->where('type_client', 'echangeur');
			$this->db->where('devise.intitule', 'CDF');
			$this->data["comptes"] = $this->db->get('client')->result_array();
			
			$this->load->view('achat', $this->data);
		}

		public function vente()
		{
			$this->db->join('devise', 'devise.iddevise = seuil.iddevise');
			$this->db->where('intitule', 'USD');
			$this->data['seuil_1'] = $this->db->get('seuil')->result_array();

			$this->db->join('devise', 'taux.iddevise = devise.iddevise');
			$this->db->where('intitule', 'USD');
			$this->data["taux"] = $this->db->get("taux")->result_array();

			$this->db->select('bonus, nom, prenom, numero_compte, montant, intitule, client.idclient, devise.iddevise, status');
			$this->db->join('compte', 'compte.idcompte = compte-fi.idcompte');
			$this->db->join('client', 'client.idclient = compte.idclient');
			$this->db->join('devise', 'devise.iddevise = compte.iddevise');
			$this->db->where('type', 'vente');
			$this->db->order_by('idcompte-fi', 'DESC');
			// $this->db->group_by('numero_compte');
			$this->data['operations'] = $this->db->get('compte-fi')->result_array();

			$this->db->join('compte', 'compte.idclient = client.idclient');
			$this->db->join('devise', 'devise.iddevise = compte.iddevise');
			$this->db->where('type_client', 'echangeur');
			$this->db->where('devise.intitule', 'USD');
			$this->data["comptes"] = $this->db->get('client')->result_array();
			
			$this->load->view('vente', $this->data);
		}

		public function bonus()
		{
			$re = [];

			$numero_compte = $this->uri->segment(3);
			$devise = $this->uri->segment(4);

			$this->db->select('sum(bonus) bonus');
			$this->db->join('compte', 'compte.idcompte = compte-fi.idcompte');
			$this->db->join('client', 'client.idclient = compte.idclient');
			$this->db->where('compte.numero_compte', $numero_compte);
			$this->db->where('iddevise', $devise);
			$this->db->where('status', 0);
			$_bonus = $this->db->get('compte-fi')->row('bonus');
			
			$seuil = $this->db->get_where('seuil', ['iddevise' => $devise])->result_array();
			if(count($seuil) > 0)
			{
				$montant = $seuil[0]["montant"];

				if($_bonus == $montant)
				{
					$this->db->select('*');
					$this->db->join('compte', 'compte.idcompte = compte-fi.idcompte');
					$this->db->join('client', 'client.idclient = compte.idclient');
					$this->db->where('compte.numero_compte', $numero_compte);
					$this->db->where('iddevise', $devise);
					$bonus = $this->db->get('compte-fi')->result_array();

					foreach($bonus as $b)
					{
						$this->db->where('idcompte-fi', $b['idcompte-fi']);
						$this->db->update('compte-fi', ['status' => 1]);
					}
					$this->data["status"] = false;
					$this->data["data"] = "Bonus déjà ajouté dans le compte principal du client";
				}
				else
				{
					$this->db->select('sum(bonus) bonus, sum(montant) montant, numero_compte, prenom, nom, devise.intitule');
					$this->db->join('compte', 'compte.idcompte = compte-fi.idcompte');
					$this->db->join('client', 'client.idclient = compte.idclient');
					$this->db->join('devise', 'devise.iddevise = compte.iddevise');
					$this->db->group_by('numero_compte');
					$this->db->where('status', 0);
					$this->db->where('compte.numero_compte', $numero_compte);
					$this->db->where('compte.iddevise', $devise);
					$bonus = $this->db->get('compte-fi')->result_array();
					
					$this->data["status"] = true;
					$this->data["data"] = $bonus;
				}

			}
			else
			{
				$this->data["status"] = false;
				$this->data["data"] = "Ajouté le seuilpour chaque montant"; 
			}

			$this->load->view('bonus', $this->data);
		}

		public function compte()
		{
			$this->data["clients"] = $this->db->get('client')->result_array();
			$this->data["devises"] = $this->db->get('devise')->result_array();

			$this->db->select('*');
			$this->db->join('compte', 'compte.idclient = client.idclient', 'left');
			$this->db->join('devise', 'devise.iddevise = compte.iddevise', 'left');
			$this->db->group_by('client.idclient');
			$this->data["client_compte"] = $this->db->get('client')->result_array();

			$this->load->view('compte', $this->data);
		}

		public function credit()
		{
			$this->data["devises"] = $this->db->get('devise')->result_array();

			$this->db->join('client', 'client.idclient = compte.idclient');
			$this->data["compte"] = $this->db->get('compte')->result_array();

			$this->db->join('compte', 'compte.idclient = client.idclient');
			$this->db->join('operation', 'compte.idcompte = operation.idcompte');
			$this->db->join('devise', 'devise.iddevise = compte.iddevise');
			$this->db->limit(5);
			$this->db->order_by('idoperation', 'DESC');
			$this->data["operation"] = $this->db->get('client')->result_array();

			// echo "<pre>";
			// print_r($data["operation"]);
			// echo "</pre>";
			// exit();

			$this->load->view('credit', $this->data);
		}

		public function debit()
		{
			$this->load->view('debit', $this->data);
		}

		public function devise()
		{
			$this->data["devises"] = $this->db->get('devise')->result_array();
			$this->load->view('devise', $this->data);
		}

		public function taux()
		{
			$this->db->join('devise', 'devise.iddevise = seuil.iddevise');
			$this->db->where('intitule', 'USD');
			$this->data['seuil_1'] = $this->db->get('seuil')->result_array();

			$this->db->join('devise', 'devise.iddevise = seuil.iddevise');
			$this->db->where('intitule', 'CDF');
			$this->data['seuil_2'] = $this->db->get('seuil')->result_array();

			$this->db->join("devise", "devise.iddevise = taux.iddevise");
			$this->db->where("devise.intitule", "USD");
			$this->data["taux_usd"] = $this->db->get('taux')->result_array();

			$this->db->join("devise", "devise.iddevise = taux.iddevise");
			$this->db->where("devise.intitule", "CDF");
			$this->data["taux_cdf"] = $this->db->get('taux')->result_array();

			$this->data["devises"] = $this->db->get('devise')->result_array();

			$this->load->view('taux', $this->data);
		}

		public function deconnexion()
		{
			$this->session->sess_destroy();
			redirect("index");
		}
	}
?>
