<?php

class clients_contacts {
    protected $id;
    protected $client_id;
    protected $field_name;
    protected $field_value;
    protected $date;
    protected $date_update;

	public function __construct() {}

    public function setId($i) {
		$this->id = $i;
	}

    public function setClient($c) {
		$this->client_id = $c;
	}

    public function setFieldName ($f) {
        $this->field_name = $f;
    }

    public function setFieldValue ($f) {
        $this->field_value = $f;
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
            "INSERT INTO %s_clients_contacts (client_id, field_name, field_value, date, date_update) VALUES ('%s', '%s', '%s', '%s', '%s')",
            $cfg->db->prefix,
            $this->client_id,
            $this->field_name,
            $this->field_value,
            $this->date,
            $this->date_update
        );

        $toReturn = $mysqli->query($query);

        $this->id = $mysqli->insert_id;

        return $toReturn;
    }

    public function update () {
        global $cfg, $mysqli;
    }

    public function delete () {
        global $cfg, $mysqli, $authData;

		$client_contact = new clients_contacts();
		$client_contact->setId($this->id);
		$client_contact = $client_contact->returnOneContact();

		$trash = new trash();
		$trash->setCode(json_encode($client_contact));
		$trash->setDate();
		$trash->setModule($cfg->mdl->folder);
		$trash->setUser($authData["id"]);
		$trash->insert();

		unset($client_contact);

		$query = sprintf(
			"DELETE FROM %s_clients_contacts WHERE id = '%s'",
			$cfg->db->prefix,
			$this->id
		);

		return $mysqli->query($query);
    }

    public function returnObject () {
        return [
            "id" => $this->id,
            "client_id" => $this->client_id,
            "field_name" => $this->field_name,
            "field_value" => $this->field_value,
            "date" => $this->date,
            "date_update" => $this->date_update
        ];
    }

    public function returnOneContact () {
        global $cfg, $mysqli;

        $query = sprintf(
            "SELECT * FROM %s_clients_contacts WHERE id = %s LIMIT %s",
            $cfg->db->prefix, $this->id, 1
        );

        return $source->fetch_object();
    }

    public function returnContactsByClient () {
        global $cfg, $mysqli;

        $query = sprintf(
            "SELECT * FROM %s_clients_contacts WHERE client_id = %s",
            $cfg->db->prefix, $this->client_id
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

    public function returnAllContacts () {
        global $cfg, $mysqli;

        $query = sprintf(
            "SELECT * FROM %s_clients_contacts WHERE true",
            $cfg->db->prefix
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
