<?php

/**
* bo3 Class
* This class holds multiple features to what represents BO3
*
* @author 	Carlos Santos
* @version 1.0
* @since 2016-10
* @license The MIT License (MIT)
*/

class bo3 {
	
	public static function c2r ($args = [], $target) {
		foreach ($args as $index => $value) {
			$target = str_replace("{c2r-$index}", $value, $target);
		}
		return $target;
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
		global $cfg, $db;

		$toReturn = [];

		foreach ($list as $key => $table) {
			$query = sprintf(
				"SELECT * FROM %s_%s LIMIT %s",
				$cfg->db->prefix, $table, 1
			);

			if ($db->query($query) !== FALSE) {
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
		global $cfg, $db;

		$query = sprintf(
			"SELECT * FROM %s_modules WHERE folder = '%s' LIMIT %s",
			$cfg->db->prefix, $folder, 1
		);

		$source = $db->query($query);

		if ($source->num_rows > 0) {
			return TRUE;
		}

		return FALSE;
	}

	public static function importPlg ($plg, $args = []) {
		global $cfg, $mdl, $lang;

		include sprintf(ROOT_DIR."/modules/plg-%s/plg-%s.php", $plg, $plg);
	}

	public static function mdl_load ($path) {
		global $cfg;

		if ($path != null) {
			return file_get_contents(ROOT_DIR."/modules/{$cfg->mdl->folder}/{$path}");
		}

		return false;
	}

	public static function plg_load ($path) {
		global $cfg;

		if ($path != null) {
			return file_get_contents(ROOT_DIR."/modules/{$cfg->plg->folder}/{$path}");
		}

		return false;
	}

	public static function load ($path = FALSE) {
		if ($path) {
			if (!file_exists(ROOT_DIR."/templates/{$path}")) {
				$target_file = fopen(ROOT_DIR."/templates/{$path}", "w") or die("Unable to open file!");
				fclose($target_file);
			}
			return file_get_contents(ROOT_DIR."/templates/{$path}");
		} else {
			$stack = debug_backtrace();
			$sorigin_file = basename($stack[0]['file'], '.php');

			if (!file_exists(ROOT_DIR."/templates/{$sorigin_file}.tpl")) {
				$target_file = fopen(ROOT_DIR."/templates/{$sorigin_file}.tpl", "w") or die("Unable to open file!");
				fclose($target_file);
			}

			return file_get_contents(ROOT_DIR."/templates/{$sorigin_file}.tpl");
		}

		return FALSE;
	}

	public static function loade ($path = FALSE) {
		if ($path) {
			if (!file_exists(ROOT_DIR."/templates-e/{$path}")) {
				$target_file = fopen(ROOT_DIR."/templates-e/{$path}", "w") or die("Unable to open file!");
				fclose($target_file);
			}
			return file_get_contents(ROOT_DIR."/templates-e/{$path}");
		}

		return false;
	}

	public static function dump($args = null) {
		print "<!--\n";
		var_dump($args);
		print "\n-->";
	}

	public static function updateFile ($file = false, $name = "", $text = "", $result = false) {
		if ($file !== false) {
			$time = date('H:i:s', time());

			$current = file_get_contents($file);
			$current .= "{$time} >> {$name} >> {$text}";
			if ($result !== false) {
				$current .= " >> {$result}";
			}
			$current .= "\n";

			file_put_contents($file, $current);
		}
	}

	public static function number_format($n) { return number_format($n, 2, ".", " "); }

	public static function sendEmailTo($from, $to, $replyTo, $subject, $message, $attach = []) {
		global $cfg;

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->CharSet = "UTF-8";
		$mail->Host = $cfg->email->smtp;
		$mail->SMTPDebug = $cfg->email->debug;
		$mail->SMTPAuth = TRUE;
		$mail->Port = $cfg->email->port;
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

	public static function generateRandomString($length = 10, $type = -1) {
		switch ($type) {
			case 0:
				$characters = "0123456789";
				break;
			case 1:
				$characters = "abcdefghijklmnopqrstuvwxyz";
				break;
			case 2:
				$characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
				break;
			case 3:
				$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
				break;
			case 4:
				$characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
				break;
			default:
				$characters = '!#$%&()*+,-./0123456789:;<=>?@ABCDEFGHIJKLMNOPQRSTUVWXYZ[\]^_abcdefghijklmnopqrstuvwxyz{|}~';
				break;
		}
		

		$randomString = '';

		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}

		return $randomString;
	}

	public static function clean($string) {
		$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
		$string =  str_replace('--', '-', $string);
		return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
	}

	public static function slugify($text){
		// replace non letter or digits by -
		$text = preg_replace('#[^\\pL\d]+#u', '-', $text);

		// trim
		$text = trim($text, '-');

		// transliterate		
		$text = bo3::toASCII($text);

		// lowercase
		$text = strtolower($text);

		// remove unwanted characters
		$text = preg_replace('#[^-\w]+#', '', $text);

		if (empty($text)) {
			return 'n-a';
		}

		return $text;
	}

	public static function toASCII( $str ) {
		return strtr(
			utf8_decode($str), 
			utf8_decode('ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ'),
			'SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy'
		);
	}

	public static function convertNumberToHours ($number = 0) {
		if ($number !== 0) {
			$minutes = $number - floor($number);

			$minutes = $minutes * 0.6;

			return str_replace(".", ":", number_format((floor( $number ) + $minutes),2));
		} else {
			return str_replace(".", ":", number_format((0.0),2));
		}
	}

}
