<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ajax extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->data["header"] = $this->load->view('style/header', '', true);
		$this->data["sidebar"] = $this->load->view('style/sidebar', '', true);
		$this->data["footer"] = $this->load->view('style/footer', '', true);
		$this->data["js"] = $this->load->view('style/js', '', true);
		$this->data["navbar"] = $this->load->view('style/navbar', '', true);

		$this->load->library('form_validation');
		$this->validation = new CI_Form_validation();
	}

	public function index()
	{
		echo "Bonjour a tous et bienvenue sur notre site";
	}

	public function solde($n_compte)
	{
		$this->db->select('sum(montant) credit');
		$this->db->where('type', 'E');
		$this->db->where('idcompte', $n_compte);
		$credit = $this->db->get('operation')->row('credit');

		$this->db->select('sum(montant) debit');
		$this->db->where('type', 'S');
		$this->db->where('idcompte', $n_compte);
		$debit = $this->db->get('operation')->row('debit');

		if ($credit >= $debit) {
			$diff = $credit - $debit;
		} else {
			$diff = 0;
		}

		return $diff;
	}

	public function login()
	{
		$this->validation->set_rules('login', '', 'required', ['required' => "Votre Login est requis"]);
		$this->validation->set_rules('password', '', 'required', ['required' => "Votre Mot de Passe est requis"]);

		$re["status"] = false;
		if ($this->validation->run()) {
			$login = $this->input->post("login", true);
			$password = $this->input->post("password", true);

			$r = $this->db->where(['login' => $login, 'password' => $password])->get("agent")->result();

			if (count($r)) {
				$this->session->set_userdata(["idagent" => $r[0]->idagent]);

				$re["status"] = true;
				$re["url"] = site_url("index/accueil");
			} else {
				$re["error"] = "Login ou Mot de Passe incorrect";
			}
		} else {
			$re["error"] = $this->validation->error_array();
		}
		echo json_encode($re);
	}

	public function add_devise()
	{
		$this->validation->set_rules('devise', '', 'required', ['required' => "Veuillez remplir la Devise svp"]);

		$re["status"] = false;
		if ($this->validation->run()) {
			$devise = $this->input->post("devise", true);
			if (count($this->db->get_where('devise', ['intitule' => $devise])->result())) {
				$re["status"] = "existe";
				$re["message"] = "Cette devise existe déjà";
			} else {
				$data = [
					"intitule" => $devise
				];

				$this->db->insert('devise', $data);

				$re["status"] = true;
				$re["message"] = "La Devise a été ajoutée avec succès";
			}
		} else {
			$re["error"] = $this->validation->error_array();
		}
		echo json_encode($re);
	}

	public function add_taux()
	{
		$this->validation->set_rules('min', '', 'required', ['required' => 'Veuillez remplir la somme minimum']);
		$this->validation->set_rules('max', '', 'required', ['required' => 'Veuillez remplir la somme maximum']);
		$this->validation->set_rules('bonus', '', 'required', ['required' => 'Veuillez renseigner le bonus']);

		$re["status"] = false;

		if ($this->validation->run()) {
			$min = $this->input->post("min");
			$max = $this->input->post("max");
			$bonus = $this->input->post("bonus");
			$devise = $this->input->post("devise");

			$r = $this->db->get_where("taux", ["min" => $min, "max" => $max, "iddevise" => $devise])->result_array();

			if (count($r)) {
				$re["status"] = "existe";
				$re["message"] = "Ce taux existe déjà";
			} else {
				$data = [
					"min" => $min,
					"max" => $max,
					"bonus" => $bonus,
					"iddevise" => $devise
				];

				$this->db->insert('taux', $data);
				$re["status"] = true;
				$re["message"] = "Le taux de bonus ajouté avec succès";
			}
		} else {
			$re["error"] = $this->validation->error_array();
		}
		echo json_encode($re);
	}

	public function add_client()
	{
		$idagent = $this->session->userdata('idagent');

		$this->validation->set_rules('nom', '', 'required', ['required' => "Veuillez renseigner le nom"]);
		$this->validation->set_rules('prenom', '', 'required', ['required' => "Veuillez renseigner le prenonom"]);
		$this->validation->set_rules('postnom', '', 'required', ['required' => "Veuillez renseigner le postnom"]);
		$this->validation->set_rules('login', '', 'required', ['required' => "Veuillez renseigner le login"]);
		$this->validation->set_rules('password', '', 'required', ['required' => "Veuillez renseigner le password"]);
		$this->validation->set_rules('adresse', '', 'required', ['required' => "Veuillez renseigner le adresse"]);
		$this->validation->set_rules('phone', '', 'required', ['required' => "Veuillez renseigner le phone"]);

		$re["status"] = false;
		if ($this->validation->run()) {
			$nom = $this->input->post('nom');
			$prenom = $this->input->post('prenom');
			$postnom = $this->input->post('postnom');

			$login = $this->input->post('login');
			$password = $this->input->post('password');
			$adresse = $this->input->post('adresse');
			$phone = $this->input->post('phone');

			$data = [
				'nom' => $nom,
				'prenom' => $prenom,
				'postnom' => $postnom,
				'login' => $login,
				'password' => $password,
				'adresse' => $adresse,
				'telephone' => $phone,
				'idagent' => $idagent
			];

			if (count($this->db->get_where('client', ['login' => $login])->result_array())) {
				$re["status"] = "existe";
				$re["message"] = "Ce Client exite déjà !";
			} else {
				$this->db->insert('client', $data);
				$re['status'] = true;
				$re['message'] = 'Le Compte Client a été crée avec succès';
			}
		} else {
			$re['error'] = $this->validation->error_array();
		}

		echo json_encode($re);
	}

	public function add_compte()
	{
		$this->validation->set_rules('numero_compte', '', 'required', ['required' => 'Veuillez remplir le champs N° Compte']);
		$this->validation->set_rules('type_compte', '', 'required', ['required' => 'Veuillez remplir le champs Type Compte']);
		$this->validation->set_rules('devise', '', 'required', ['required' => 'Veuillez remplir le champs Devise']);
		$this->validation->set_rules('type_client', '', 'required', ['required' => 'Veuillez remplir le champs Type Client']);
		$this->validation->set_rules('client', '', 'required', ['required' => 'Veuillez remplir le champs Client']);

		$re["status"] = false;

		if ($this->validation->run()) {
			$n_compte = $this->input->post('numero_compte');
			$t_compte = $this->input->post('type_compte');
			$devise = $this->input->post('devise');
			$t_client = $this->input->post('type_client');
			$id_client = $this->input->post('client');

			if (count($this->db->get_where('compte', ['numero_compte' => $n_compte])->result_array())) {
				$re["status"] = "existe";
				$re["message"] = "Ce compte existe déjà !";
			} else {
				$data = [
					'numero_compte' => $n_compte,
					'type_compte' => $t_compte,
					'iddevise' => $devise,
					'type_client' => $t_client,
					'idclient' => $id_client
				];

				$this->db->insert('compte', $data);

				$re["status"] = true;
				$re["message"] = 'Compte crée avec succès';
			}
		} else {
			$re["error"] = $this->validation->error_array();
		}

		echo json_encode($re);
	}

	public function depot()
	{
		$this->validation->set_rules('compte', '', 'required', ['required' => 'Selectionnez un compte']);
		$this->validation->set_rules('montant', '', 'required', ['required' => 'Entrez le montant']);

		$re["status"] = false;

		if ($this->validation->run()) {
			$compte = $this->input->post('compte');
			$montant = $this->input->post('montant');
			$operation = $this->input->post('operation');
			if ($operation == 'depot') {
				$data = [
					"montant" => $montant,
					"idcompte" => $compte,
					"type" => 'E'
				];

				$this->db->insert('operation', $data);
				$re["status"] = true;
				$re["message"] = "Votre Dépôt a été effectué avec succès";
			} else {
				$diff = $this->solde($compte);
				if ($diff > 0) {
					if ($diff >= $montant) {
						$data = [
							"montant" => $montant,
							"idcompte" => $compte,
							"type" => 'S'
						];

						$this->db->insert('operation', $data);
						$re["status"] = true;
						$re["message"] = "Votre Retrait a été effectué avec succès";
					} else {
						$re["status"] = true;
						$re["message"] = "Le Solde pour ce Compte est inferieur a " . $montant;
					}
				} else {
					$re["status"] = false;
					$re["message"] = "Votre solde est null soit " . $diff;
				}
			}
		} else {
			$re["error"] = $this->validation->error_array();
		}

		echo json_encode($re);
	}

	public function seuil()
	{
		$this->load->library('form_validation');
		$validation  = new CI_Form_validation();

		$validation->set_rules('montant', '', 'required', ['required' => 'Remplissez ce champs']);
		$validation->set_rules('devise', '', 'required', ['required' => 'Selectionnez la Devise']);

		$re["status"] = false;

		if ($validation->run()) {
			$montant = $this->input->post("montant");
			$devise = $this->input->post('devise');

			$seuil = $this->db->get_where('seuil', ['iddevise' => $devise])->result_array();

			if (count($seuil) > 0) {
				$data = [
					"montant" => $montant,
					"iddevise" => $devise,
				];

				$this->db->where('idseuil', $seuil[0]['idseuil']);
				$this->db->update('seuil', $data);

				$re["message"] = "Mise à jour effectuée avec succès";
				$re["status"] = true;
			} else {
				$data = [
					"montant" => $montant,
					"iddevise" => $devise,
				];

				$this->db->insert('seuil', $data);

				$re["message"] = "Le Montant Seuil ajouté avec succès";
				$re["status"] = true;
			}
		} else {
			$re["error"] = $validation->error_array();
		}

		echo json_encode($re);
	}

	public function bonus($devise = 9, $numero_compte = "098765432112345678")
	{
		$this->db->select('sum(bonus) bonus');
		$this->db->join('compte', 'compte.idcompte = compte-fi.idcompte');
		$this->db->join('client', 'client.idclient = compte.idclient');
		$this->db->where('compte.numero_compte', $numero_compte);
		$this->db->where('iddevise', $devise);
		$this->db->where('status', 0);
		$_bonus = $this->db->get('compte-fi')->row('bonus');

		$seuil = $this->db->get_where('seuil', ['iddevise' => $devise])->result_array();

		$r = false;
		echo "<pre>";
		print_r($seuil);
		echo "</pre>";
		exit();
		if (count($seuil) > 0)
		{

			$montant = $seuil[0]["montant"];

			if ($_bonus == $montant) 
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
				$r = true;
			}
			else
			{
				$r = false;
			}
		} 
		else 
		{
			$r = false;
		}
		return $r;
	}

	public function vente()
	{
		$this->db->select('min, max, idtaux, bonus, taux.iddevise');
		$this->db->join('devise', 'devise.iddevise = taux.iddevise');
		$taux = $this->db->get_where('taux', ["intitule" => 'USD'])->result_array();

		$this->validation->set_rules('compte', '', 'required', ['required' => 'Selectionnez un compte']);
		$this->validation->set_rules('montant', '', 'required', ['required' => 'Entrez le montant']);

		$devise = '';

		$re["status"] = false;
		$bonus = 0;

		$t_v = [];

		if ($this->validation->run())
		{
			$compte = $this->input->post('compte');
			$montant = $this->input->post('montant');

			foreach ($taux as $t) {
				if ($montant >= $t["min"] and $montant <= $t['max']) {
					$bonus = $t["bonus"];
					$taux = $t["idtaux"];
					array_push($t_v, $bonus);
				}
			}

			if (count($t_v) > 0) 
			{
				$collection = [
					'bonus' => $bonus,
					'idcompte' => $compte,
					'montant' => $montant,
					'idtaux' => $taux,
					'type' => 'vente',
					'status' => 0
				];

				$this->db->insert('compte-fi', $collection);
				if($this->bonus($devise, $compte))
				{
					$re["message"] = "Virement bonus effectue avec succès";
				}
				else
				{
					$re["message"] = "L'Opération d'echange s'est bien effectuée";

					// Putting code to send message

				}
				$re["status"] = true;
			} else {
				$re["message"] = "L'Opération a echoué. Referez-vous à la partie Taux Bonus pour voir le montant min et max autorisé";
				$re["status"] = false;
			}
		} else {
			$re["error"] = $this->validation->error_array();
		}

		echo "<pre>";
		print_r($re);
		echo "</pre>";
		exit();


		echo json_encode($re);
	}

	public function achat()
	{
		$this->db->select('min, max, idtaux, bonus, taux.iddevise');
		$this->db->join('devise', 'devise.iddevise = taux.iddevise');
		$taux = $this->db->get_where('taux', ["intitule" => 'CDF'])->result_array();

		$this->validation->set_rules('compte', '', 'required', ['required' => 'Selectionnez un compte']);
		$this->validation->set_rules('montant', '', 'required', ['required' => 'Entrez le montant']);

		$devise = '';

		$re["status"] = false;
		$bonus = 0;

		$t_v = [];

		if ($this->validation->run()) {
			$compte = $this->input->post('compte');
			$montant = $this->input->post('montant');

			foreach ($taux as $t) {
				if ($montant >= $t["min"] and $montant <= $t['max']) {
					$bonus = $t["bonus"];
					$taux = $t["idtaux"];
					array_push($t_v, $bonus);
				}
			}

			if (count($t_v) > 0) {
				$collection = [
					'bonus' => $bonus,
					'idcompte' => $compte,
					'montant' => $montant,
					'idtaux' => $taux,
					'type' => 'achat'

				];

				$this->db->insert('compte-fi', $collection);
				$re["message"] = "L'Opération d'echange s'est bien effectuée";
				$re["status"] = true;
			} else {
				$re["message"] = "L'Opération a echoué. Entrez un montant supérieur à " . $montant;
				$re["status"] = false;
			}
		} else {
			$re["error"] = $this->validation->error_array();
		}

		echo json_encode($re);
	}

	public function get_devise()
	{
		$compte = $this->input->get('compte', true);
		$this->db->join('devise', 'compte.iddevise = devise.iddevise');
		$devise["devise"] = $this->db->get_where('compte', ['compte.idcompte' => $compte])->row('intitule');

		$devise["solde"] = $this->solde($compte) . ' ' . $devise["devise"];

		echo json_encode($devise);
	}
}
