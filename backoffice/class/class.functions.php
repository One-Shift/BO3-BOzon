<?php

class functions {
	public static function number_format($n) {
		return number_format($n, 2, ".", " ");
	}

	public static function sendEmailTo($from, $to, $replyTo, $subject, $message, $attach = []) {
		global $cfg;

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->CharSet = "UTF-8";
		$mail->Host = $cfg->email->smtp;
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = TRUE;
		$mail->Port = 25;
		$mail->SMTPSecure = $cfg->email->secure;
		$mail->Username = $cfg->email->username;
		$mail->Password = $cfg->email->password;
		$mail->SetFrom($from, $cfg->system->sitename);
		$mail->Subject = $subject;
		$mail->AddAddress($to, "User");
		$mail->AddReplyTo($replyTo);
		$mail->MsgHTML($message);


		if (count($attach) > 0) {
			foreach ($attach as $file) {
				$mail->addAttachment($file[0], $file[1]);
			}
		}

		if (!$mail->Send()) {
			return FALSE;
		} else {
			return TRUE;
		}
	}

	public static function generateRandomString($length = 10) {
		// work 100%
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		// in beta testing
		$characters = '!#$%&()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_abcdefghijklmnopqrstuvwxyz{|}~';

		$randomString = '';

		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}

		return $randomString;
	}

	public static function clean($string) {
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}

	public static function minifyPage($buffer) {
		/* origin http://jesin.tk/how-to-use-php-to-minify-html-output/ */
		$search = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');

		$replace = array('>', '<', '\\1');

		if (preg_match("/\<html/i", $buffer) == 1 && preg_match("/\<\/html\>/i", $buffer) == 1) {
			$buffer = preg_replace($search, $replace, $buffer);
		}

		$buffer = preg_replace('/<!--(.|\s)*?-->/', '', $buffer);

		return $buffer;
	}

	public static function minifyHTML($buffer) {
		$search = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');

		$replace = array('>', '<', '\\1');

		$buffer = preg_replace($search, $replace, $buffer);

		$buffer = preg_replace('/<!--(.|\s)*?-->/', '', $buffer);

		return $buffer;
	}

	public static function dbTableExists ($list = []) {
		global $cfg, $mysqli;

		$toReturn = [];

		foreach ($list as $key => $table) {
			$query = sprintf(
				"SELECT * FROM %s_%s LIMIT %s",
				$cfg->db->prefix, $table, 1
			);

			if ($mysqli->query($query) !== FALSE) {
				array_push($toReturn, TRUE);
			} else {
				array_push($toReturn, FALSE);
			}
		}

		foreach ($toReturn as $key => $value) {
			if ($value == FALSE) {
				return FALSE;
			}
		}

		return TRUE;
	}

	public static function mdlInstalled ($folder) {
		global $cfg, $mysqli;

		$query = sprintf(
			"SELECT * FROM %s_modules WHERE folder = '%s' LIMIT %s",
			$cfg->db->prefix, $folder, 1
		);

		$source = $mysqli->query($query);

		if ($source->num_rows > 0) {
			return TRUE;
		}

		return FALSE;
	}

	public static function importPlg ($plg, $args = []) {
		global $cfg, $mdl, $lang;

		include sprintf("modules/plg-%s/plg-%s.php", $plg, $plg);
	}

	public static function mdl_load ($path) {
		global $cfg;

		if ($path != null) {
			return file_get_contents("modules/{$cfg->mdl->folder}/{$path}");
		}

		return false;
	}

	public static function load ($path) {
		global $cfg;

		if ($path != null) {
			return file_get_contents("templates/{$path}");
		}

		return false;
	}

	public static function loade ($path) {
		global $cfg;

		if ($path != null) {
			return file_get_contents("templates-e/{$path}");
		}

		return false;
	}

	public static function convertNumberToHours ($number = 0) {
		if ($number !== 0) {
			$minutes = $number - floor($number);

			$minutes = $minutes * 0.6;

			return str_ireplace(".", ":", number_format((floor( $number ) + $minutes),2));
		} else {
			return str_ireplace(".", ":", number_format((0.0),2));
		}
	}
}
