<?php
    function useCurrency($lang, $amount) {
		if (!function_exists('money_format')) {
			if ($lang == "EN") {
				if ($amount<0) return "-".asDollars(-$amount);
				return '&pound;' . number_format($amount, 2);
			} else {
				if ($amount<0) return "-".asDollars(-$amount);
				return '&euro;' . number_format($amount, 2);
			}
		} else {
			if ($lang == "EN") {
				setlocale(LC_MONETARY, 'en_GB');
				return utf8_encode(money_format('%n',$amount));
			} elseif ($lang == "IT") {
				setlocale(LC_MONETARY, 'it_IT.UTF-8');
				$amount = money_format('%.2n', $amount);
				return str_replace('Eu','&euro;',$amount);
			}
		}
    }

    function theme($theme) {
        if ($theme == "default") {
            return "success";
        } elseif ($theme == "blue") {
            return "primary";
        } elseif ($theme == "yellow") {
            return "warning";
        } else {
            return "success";
        }
    }
    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
    
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
    
        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }
    
        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    function write_php_ini($array, $file) {
        $res = array();
        foreach($array as $key => $val) {
            if(is_array($val)) {
                $res[] = "[$key]";
                foreach($val as $skey => $sval) $res[] = "$skey = ".(is_numeric($sval) ? $sval : '"'.$sval.'"');
            }
            else $res[] = "$key = ".(is_numeric($val) ? $val : '"'.$val.'"');
        }
        safefilerewrite($file, implode("\r\n", $res));
    }
    
    function safefilerewrite($fileName, $dataToSave) {    
        if ($fp = fopen($fileName, 'w')) {
            $startTime = microtime(TRUE);
            do {
                $canWrite = flock($fp, LOCK_EX);
               // If lock not obtained sleep for 0 - 100 milliseconds, to avoid collision and CPU load
               if(!$canWrite) usleep(round(rand(0, 100)*1000));
            }
            while ((!$canWrite)and((microtime(TRUE)-$startTime) < 5));
    
            //file was locked so now we can store information
            if ($canWrite) {
                fwrite($fp, $dataToSave);
                flock($fp, LOCK_UN);
            }
            fclose($fp);
        }
    }
?>