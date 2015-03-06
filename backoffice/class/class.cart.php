<?php

class cart {

    protected $date;
    protected $date_update;

    public function setDate($d = null) {
        $this->date = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
    }

    public function setDateUpdate($d = null) {
        $this->date_update = ($d !== null) ? $d : date("Y-m-d H:i:s", time());
    }

    public function __construct() {

    }

    public function add($u, $i) {
        global $configuration, $mysqli;
        $query[1] = sprintf("SELECT id FROM %s_cart WHERE user_id = '%s' AND product_id = '%s'", $configuration["mysql-prefix"], $u, $i);
        $source[1] = $mysqli->query($query[1]);

        if ($source[1]->num_rows > 0) {
            return $this->addQuantity($u, $i);
        } else {
            $query[0] = sprintf("INSERT INTO %s_cart (user_id, product_id, date, date_update) VALUES ('%s', '%s', '%s', '%s')", $configuration["mysql-prefix"], $u, $i, $this->date, $this->date_update);

            return $mysqli->query($query[0]);
        }
    }

    public function sub($u, $i) {
        global $configuration, $mysqli;
        $query[1] = sprintf("SELECT id, quantity FROM %s_cart WHERE user_id = '%s' AND product_id = '%s'", $configuration["mysql-prefix"], $u, $i);
        $source[1] = $mysqli->query($query[1]);
        $data[1] = $source[1]->fetch_assoc();

        if ($data[1]["quantity"] > 1) {
            return $this->subQuantity($u, $i);
        } else {
            $query[0] = sprintf("DELETE FROM %s_cart WHERE user_id = '%s' AND product_id = '%s' AND quantity = '%s'", $configuration["mysql-prefix"], $u, $i, 1);

            return $mysqli->query($query[0]);
        }
    }

    public function addQuantity($u, $i) {
        global $configuration, $mysqli;

        $query[0] = sprintf("UPDATE %s_cart SET quantity = quantity + 1 WHERE user_id = '%s' AND product_id = '%s'", $configuration["mysql-prefix"], $u, $i);

        return $mysqli->query($query[0]);
    }

    public function subQuantity($u, $i) {
        global $configuration, $mysqli;

        $query[0] = sprintf("UPDATE %s_cart SET quantity = quantity - 1 WHERE user_id = '%s' AND product_id = '%s'", $configuration["mysql-prefix"], $u, $i);

        return $mysqli->query($query[0]);
    }

    public function remove($u, $i) {
        global $configuration, $mysqli;

        $query[0] = sprintf("DELETE FROM %s_cart WHERE user_id = '%s' AND product_id = '%s'", $configuration["mysql-prefix"], $u, $i);

        return $mysqli->query($query[0]);
    }

    public function emptyCart($u) {
        global $configuration, $mysqli;

        $query[0] = sprintf("DELETE FROM %s_cart WHERE user_id = '%s'", $configuration["mysql-prefix"], $u);

        return $mysqli->query($query[0]);
    }

}
