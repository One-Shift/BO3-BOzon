<?php

/**
 *
 */
class ClassName extends AnotherClass {

	public static function log ($user_id, $module, $description) {
		global $cfg, $db;


		$db = self::instance()->obj;
		try {
			$db->beginTransaction();
			$db->commit();
			$instance = $db->prepare("INSERT INTO {$cfg->db->prefix}_log (user_id, module, description) VALUES (':user_id', ':module', ':description')")
			$instance->execute(['email' => $_POST["input-email"], 'status' => true, 'limit' => 1]);
			$db->exec($sql);
		} catch (\PDOException $e) {
			//Something went wrong rollback!
			$db->rollBack();
			throw new MysqlException($e->getMessage());
		}
	}
}
