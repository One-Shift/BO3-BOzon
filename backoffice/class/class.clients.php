<?php

class clients {
    protected $id;
    protected $billing_name;
    protected $comercial_name;
    protected $tax_number;
    protected $business_id;
    protected $user_id;
    protected $date;
    protected $date_update;

	public function __construct() {}

    public function setId ($i) {
        $this->id = (int)$i;
    }

    public function setBillingName ($n) {
        $this->billing_name = $n;
    }

    public function setComercialName ($n) {
        $this->comercial_name = $n;
    }

    public function setBusiness ($b) {
        $this->business_id = (int)$b;
    }

    public function setTaxNumber ($t) {
        $this->tax_number = (int)$t;
    }

    public function setUser ($u) {
        $this->user_id = (int)$u;
    }

	public function setDate ($d = null) {
		$this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

	public function setDateUpdate ($d = null) {
		$this->date_update = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
	}

    public function insert () {
        global $cfg, $mysqli;

        $query = sprintf(
            "INSERT INTO %s_clients (billing_name, comercial_name, tax_number, business_id, user_id, date, date_update) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s')",
            $cfg->db->prefix,
            $this->billing_name,
            $this->comercial_name,
            $this->tax_number,
            $this->business_id,
            $this->user_id,
            $this->date,
            $this->date_update
        );

        $toReturn = $mysqli->query($query);

		$this->id = $mysqli->insert_id;

		return $toReturn;
    }

    public function update () {
        global $cfg, $mysqli;

        $query = sprintf(
            "UPDATE %s_clients SET billing_name = '%s', comercial_name = '%s', tax_number = '%s', business_id = '%s' user_id = '%s', date = '%s', date_update = '%s' WHERE id = '%s'",
            $cfg->db->prefix,
            $this->billing_name,
            $this->comercial_name,
            $this->tax_number,
            $this->business_id,
            $this->user_id,
            $this->date,
            $this->date_update,
            $this->id
        );

        return $mysqli->query($query);
    }

    public function delete () {
        global $cfg, $mysqli, $authData;

        $client = new client();
        $client->setId($this->id);
        $client = $client->returnOneClient();

        $trash = new trash();
		$trash->setCode(json_encode($client));
		$trash->setDate();
		$trash->setModule($cfg->mdl->folder);
		$trash->setUser($authData["id"]);
		$trash->insert();

		unset($client);

        $query = sprintf(
			"DELETE FROM %s_clients WHERE id = '%s'",
			$cfg->db->prefix,
			$this->id
		);

		return $mysqli->query($query);
    }

    public function returnObject () {
        return [
            "id" => $this->id,
            "billing_name" => $this->billing_name,
            "comercial_name" => $this->comercial_name,
            "tax_number" => $this->tax_number,
            "business_id" => $this->business_id,
            "user_id" => $this->user_id,
            "date" => $this->date,
            "date_update" => $this->date_update
        ];
    }

    public function returnOneClient () {
        global $cfg, $mysqli;

		$query = sprintf(
            "SELECT * FROM %s_clients WHERE id = '%s' LIMIT 1",
            $cfg->db->prefix,
            $this->id
        );

		$source = $mysqli->query($query);

        return $source->fetch_object();
    }

    public function returnAllClients () {
        global $cfg, $mysqli;

        $query = sprintf(
            "SELECT * FROM %s_clients WHERE true ORDER BY %s",
            $cfg->db->prefix, "id ASC"
        );
		$source = $mysqli->query($query);

		$toReturn = [];
		$i = 0;

		while ($data = $source->fetch_object()) {
			$toReturn[$i] = $data;
			$i++;
		}

		return $toReturn;
    }
}
