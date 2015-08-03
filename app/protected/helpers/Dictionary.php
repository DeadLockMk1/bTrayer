<?php
class Dictionary
{
    public function switchCh($text, $arrow = 0)
    {
        $str[0] = array(
            'й' => 'q',
            'ц' => 'w',
            'у' => 'e',
            'к' => 'r',
            'е' => 't',
            'н' => 'y',
            'г' => 'u',
            'ш' => 'i',
            'щ' => 'o',
            'з' => 'p',
            'х' => '[',
            'ъ' => ']',
            'ф' => 'a',
            'ы' => 's',
            'в' => 'd',
            'а' => 'f',
            'п' => 'g',
            'р' => 'h',
            'о' => 'j',
            'л' => 'k',
            'д' => 'l',
            'ж' => ';',
            'э' => '\'',
            'я' => 'z',
            'ч' => 'x',
            'с' => 'c',
            'м' => 'v',
            'и' => 'b',
            'т' => 'n',
            'ь' => 'm',
            'б' => ',',
            'ю' => '.',
            'Й' => 'Q',
            'Ц' => 'W',
            'У' => 'E',
            'К' => 'R',
            'Е' => 'T',
            'Н' => 'Y',
            'Г' => 'U',
            'Ш' => 'I',
            'Щ' => 'O',
            'З' => 'P',
            'Х' => '[',
            'Ъ' => ']',
            'Ф' => 'A',
            'Ы' => 'S',
            'В' => 'D',
            'А' => 'F',
            'П' => 'G',
            'Р' => 'H',
            'О' => 'J',
            'Л' => 'K',
            'Д' => 'L',
            'Ж' => ';',
            'Э' => '\'',
            '?' => 'Z',
            'ч' => 'X',
            'С' => 'C',
            'М' => 'V',
            'И' => 'B',
            'Т' => 'N',
            'Ь' => 'M',
            'Б' => ',',
            'Ю' => '.'
        );
        $str[1] = array(
            'q' => 'й',
            'w' => 'ц',
            'e' => 'у',
            'r' => 'к',
            't' => 'е',
            'y' => 'н',
            'u' => 'г',
            'i' => 'ш',
            'o' => 'щ',
            'p' => 'з',
            '[' => 'х',
            ']' => 'ъ',
            'a' => 'ф',
            's' => 'ы',
            'd' => 'в',
            'f' => 'а',
            'g' => 'п',
            'h' => 'р',
            'j' => 'о',
            'k' => 'л',
            'l' => 'д',
            ';' => 'ж',
            '\'' => 'э',
            'z' => 'я',
            'x' => 'ч',
            'c' => 'с',
            'v' => 'м',
            'b' => 'и',
            'n' => 'т',
            'm' => 'ь',
            ',' => 'б',
            '.' => 'ю',
            'Q' => 'Й',
            'W' => 'Ц',
            'E' => 'У',
            'R' => 'К',
            'T' => 'Е',
            'Y' => 'Н',
            'U' => 'Г',
            'I' => 'Ш',
            'O' => 'Щ',
            'P' => 'З',
            '[' => 'Х',
            ']' => 'Ъ',
            'A' => 'Ф',
            'S' => 'Ы',
            'D' => 'В',
            'F' => 'А',
            'G' => 'П',
            'H' => 'Р',
            'J' => 'О',
            'K' => 'Л',
            'L' => 'Д',
            ';' => 'Ж',
            '\'' => 'Э',
            'Z' => '?',
            'X' => 'ч',
            'C' => 'С',
            'V' => 'М',
            'B' => 'И',
            'N' => 'Т',
            'M' => 'Ь',
            ',' => 'Б',
            '.' => 'Ю'
        );
        return strtr($text, isset($str[$arrow]) ? $str[$arrow] : array_merge($str[0], $str[1]));
    }
    public function getDescriptions()
    {
        $list = parse_ini_file(Yii::app()->basePath.'/config/descriptions.ini', true);
        return $this->setNl2br($list);
    }

    public function setNl2br ($in)
    {
        if (!is_array($in)) {
            return nl2br($in);
        }
        foreach ($in as $k=>$v) {
            if (is_array($v)) {
                $in[$k] = $this->setNl2br($v);
            } else {
                $in[$k] = nl2br($v);
            }
        }
        return $in;
    }

    public function getUsernames() {
        // $usrObjArray = User::model()->findAllByAttributes(array(),'status=1');
        $users = Yii::app()->db->createCommand()
                               ->select('username')
                               ->from('users')
                               ->queryAll();
        echo "<pre>"; var_dump($users); die();
        foreach ($users as $record) {
            $usernames[] = $record['username'];
        }
        return $usernames;
    }

    public static function getUserData($uid) {
        $users = Yii::app()->db->createCommand()
            ->select('users.username, profiles.firstname')
            ->from('users, profiles')
            ->where("id=$uid AND users.id=profiles.user_id")
            ->queryRow();
        return $users;
    }

    public function getUIDByString($str) {
        $id = Yii::app()->db->createCommand()
                               ->select('id')
                               ->from('users')
                               ->where(array('or', "username='$str'", "email='$str'", "id='$str'"))
                               ->queryAll();
        if (!empty($id))
            return $id[0]['id'];
        else
            return '0';
    }
    public function getSitesOfUser($users = array())
    {
        if (empty($users)) {
            $ids = Yii::app()->db->createCommand()
                ->select('id')
                ->from('users')
                ->where("status=1")
                ->queryAll();
            foreach ($ids as $id) {
                $users[] = $id['id'];
            }
        }
        $sites = Yii::app()->db->createCommand()
            ->select('Site_Id')
            ->from('users_sites_rights')
            ->where("User_Id IN (". implode($users, ', ') .")")
            ->queryAll();
        foreach ($sites as $site) {
            $ret[] = '"'.$site['Site_Id'].'"';
        }
        if (!isset($ret) || empty($ret)) {
            return '""';
        }
        return implode($ret, ', ');
    }
    public static function userHasRights($userId, $siteId) {
        $sites = Yii::app()->db->createCommand()
            ->select('Site_Id')
            ->from('users_sites_rights')
            ->where("User_Id='". $userId ."'")
            ->queryAll();
    }
    public static function getErrorsStringByMask($errorMask) {
        $ret = "";
        $eTypes = array();
        if ($errorMask == '0')
            return false;
        $mask = $errorMask;
        for ($power = 0; $power <= 64; $power++) {
            $error = $mask & pow(2, $power);
            if ($error != 0) {
                $eTypes[] = $power;
            }
        }
        $errors = self::getErrorsByMask($eTypes);
        $len = count($errors);
        foreach ($errors as $i => $error) {
            if ($i+1 == $len) {
                $ret .= $error["errorType"];
            } else {
                $ret .= $error["errorType"] . ", | ";
            }
        }
        return $ret;
    }

    public function getErrorsByMask($errorMask)
    {
        $errors = array();
        foreach ($errorMask as $value) {
            switch ((string) $value) {
                case '0':
                    $errors[] = array(
                        'errorType' => 'Wrong URL'
                    );
                    break;
                case '1':
                    $errors[] = array(
                        'errorType' => 'Timeout'
                    );
                    break;
                case '2':
                    $errors[] = array(
                        'errorType' => 'HTTP error'
                    );
                    break;
                case '3':
                    $errors[] = array(
                        'errorType' => 'Empty content'
                    );
                    break;
                case '4':
                    $errors[] = array(
                        'errorType' => 'Wrong MIME type'
                    );
                    break;
                case '5':
                    $errors[] = array(
                        'errorType' => 'Connection error'
                    );
                    break;
                case '6':
                    $errors[] = array(
                        'errorType' => 'Code page convert error'
                    );
                    break;
                case '7':
                    $errors[] = array(
                        'errorType' => 'Bad redirection'
                    );
                    break;
                case '8':
                    $errors[] = array(
                        'errorType' => 'Size error'
                    );
                    break;
                case '9':
                    $errors[] = array(
                        'errorType' => 'Authorization error'
                    );
                    break;
                case '10':
                    $errors[] = array(
                        'errorType' => 'File operation error, write file, create directory and so on'
                    );
                    break;
                case '11':
                    $errors[] = array(
                        'errorType' => 'Robots.txt rule not matched'
                    );
                    break;
                case '12':
                    $errors[] = array(
                        'errorType' => 'HTML parse error'
                    );
                    break;
                case '13':
                    $errors[] = array(
                        'errorType' => 'Bad encoding'
                    );
                    break;
                case '14':
                    $errors[] = array(
                        'errorType' => 'Max errors'
                    );
                    break;
                case '15':
                    $errors[] = array(
                        'errorType' => 'Max resources'
                    );
                    break;
                case '16':
                    $errors[] = array(
                        'errorType' => 'Raw content not stored'
                    );
                    break;
                case '17':
                    $errors[] = array(
                        'errorType' => 'Max HTTP redirects'
                    );
                    break;
                case '18':
                    $errors[] = array(
                        'errorType' => 'MAX HTML redirects'
                    );
                    break;
                case '19':
                    $errors[] = array(
                        'errorType' => 'Wrong HTML structure'
                    );
                    break;
                case '20':
                    $errors[] = array(
                        'errorType' => 'Wrong DTD'
                    );
                    break;
                case '21':
                    $errors[] = array(
                        'errorType' => 'Content-Type detection'
                    );
                    break;
                case '22':
                    $errors[] = array(
                        'errorType' => 'Fetcher ambiguous request'
                    );
                    break;
                case '23':
                    $errors[] = array(
                        'errorType' => 'Connection'
                    );
                    break;
                case '24':
                    $errors[] = array(
                        'errorType' => 'HTTP request'
                    );
                    break;
                case '25':
                    $errors[] = array(
                        'errorType' => 'Wrong URL'
                    );
                    break;
                case '26':
                    $errors[] = array(
                        'errorType' => 'Max redirects'
                    );
                    break;
                case '27':
                    $errors[] = array(
                        'errorType' => 'Connection timeout'
                    );
                    break;
                case '28':
                    $errors[] = array(
                        'errorType' => 'Read timeout'
                    );
                    break;
                case '29':
                    $errors[] = array(
                        'errorType' => 'Fetch timeout'
                    );
                    break;
                case '30':
                    $errors[] = array(
                        'errorType' => 'FETCH_UNDEFINED'
                    );
                    break;
                case '31':
                    $errors[] = array(
                        'errorType' => 'General fault'
                    );
                    break;
                case '32':
                    $errors[] = array(
                        'errorType' => 'Max errors'
                    );
                    break;
                case '33':
                    $errors[] = array(
                        'errorType' => 'Max resources'
                    );
                    break;
                case '34':
                    $errors[] = array(
                        'errorType' => 'Unsupported Content-Type'
                    );
                    break;
                case '35':
                    $errors[] = array(
                        'errorType' => 'URL encoding'
                    );
                    break;
                case '36':
                    $errors[] = array(
                        'errorType' => 'Scraping fault'
                    );
                    break;
                case '37':
                    $errors[] = array(
                        'errorType' => 'Raw content absent'
                    );
                    break;
                case '38':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(38)'
                    );
                    break;
                case '39':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(39)'
                    );
                    break;
                case '40':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(40)'
                    );
                    break;
                case '41':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(41)'
                    );
                    break;
                case '42':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(42)'
                    );
                    break;
                case '43':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(43)'
                    );
                    break;
                case '44':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(44)'
                    );
                    break;
                case '45':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(45)'
                    );
                    break;
                case '46':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(46)'
                    );
                    break;
                case '47':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(47)'
                    );
                    break;
                case '48':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(48)'
                    );
                    break;
                case '49':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(49)'
                    );
                    break;
                case '50':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(50)'
                    );
                    break;
                case '51':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(51)'
                    );
                    break;
                case '52':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(52)'
                    );
                    break;
                case '53':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(53)'
                    );
                    break;
                case '54':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(54)'
                    );
                    break;
                case '55':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(55)'
                    );
                    break;
                case '56':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(56)'
                    );
                    break;
                case '57':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(57)'
                    );
                    break;
                case '58':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(58)'
                    );
                    break;
                case '59':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(59)'
                    );
                    break;
                case '60':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(60)'
                    );
                    break;
                case '61':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(61)'
                    );
                    break;
                case '62':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(62)'
                    );
                    break;
                case '63':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(63)'
                    );
                    break;
                case '64':
                    $errors[] = array(
                        'errorType' => 'UNKNOWNERROR(64)'
                    );
                    break;
                default:
                    # code...
                    break;
            }
        }
        return $errors;
    }
     public function getTagsByMask($tagsMask)
    {
        $tags = array();
        foreach ($tagsMask as $value) {
            switch ((string) $value) {
                case '0':
                    $tags[] = array(
                        'tag' => 'media'
                    );
                    break;
                case '1':
                    $tags[] = array(
                        'tag' => 'publication date'
                    );
                    break;
                case '2':
                    $tags[] = array(
                        'tag' => 'content_encoded'
                    );
                    break;
                case '3':
                    $tags[] = array(
                        'tag' => 'title'
                    );
                    break;
                case '4':
                    $tags[] = array(
                        'tag' => 'link'
                    );
                    break;
                case '5':
                    $tags[] = array(
                        'tag' => 'description'
                    );
                    break;
                case '6':
                    $tags[] = array(
                        'tag' => 'UPDATED_PARSED'
                    );
                    break;
                case '7':
                    $tags[] = array(
                        'tag' => 'creation date'
                    );
                    break;
                case '8':
                    $tags[] = array(
                        'tag' => 'author'
                    );
                    break;
                case '9':
                    $tags[] = array(
                        'tag' => 'guid (rss)'
                    );
                    break;
                case '10':
                    $tags[] = array(
                        'tag' => 'keywords'
                    );
                    break;
                case '11':
                    $tags[] = array(
                        'tag' => 'media thumbnail'
                    );
                    break;
                case '12':
                    $tags[] = array(
                        'tag' => 'enclosure (rss)'
                    );
                    break;
                case '13':
                    $tags[] = array(
                        'tag' => 'media (rss)'
                    );
                    break;
                case '14':
                    $tags[] = array(
                        'tag' => 'google search'
                    );
                    break;
                case '15':
                    $tags[] = array(
                        'tag' => 'google search total'
                    );
                    break;
                case '16':
                    $tags[] = array(
                        'tag' => 'html lang'
                    );
                    break;
                case '17':
                    $tags[] = array(
                        'tag' => 'parent rss'
                    );
                    break;
                case '18':
                    $tags[] = array(
                        'tag' => 'parent rss urlmd5'
                    );
                    break;
                case '19':
                    $tags[] = array(
                        'tag' => 'summary detail'
                    );
                    break;
                case '20':
                    $tags[] = array(
                        'tag' => 'summary'
                    );
                    break;
                case '21':
                    $tags[] = array(
                        'tag' => 'comments'
                    );
                    break;
                case '22':
                    $tags[] = array(
                        'tag' => 'tags (rss)'
                    );
                    break;
                case '23':
                    $tags[] = array(
                        'tag' => 'updated'
                    );
                    break;
                case '24':
                    $tags[] = array(
                        'tag' => 'UNKNOWN_TAG(24)'
                    );
                    break;
                case '25':
                    $tags[] = array(
                        'tag' => 'UNKNOWN_TAG(25)'
                    );
                    break;
                case '26':
                    $tags[] = array(
                        'tag' => 'UNKNOWN_TAG(26)'
                    );
                    break;
                case '27':
                    $tags[] = array(
                        'tag' => 'UNKNOWN_TAG(27)'
                    );
                    break;
                case '28':
                    $tags[] = array(
                        'tag' => 'UNKNOWN_TAG(28)'
                    );
                    break;
                case '29':
                    $tags[] = array(
                        'tag' => 'UNKNOWN_TAG(29)'
                    );
                    break;
                case '30':
                    $tags[] = array(
                        'tag' => 'UNKNOWN_TAG(30)'
                    );
                    break;
                case '31':
                    $tags[] = array(
                        'tag' => 'UNKNOWN_TAG(31)'
                    );
                    break;
                case '32':
                    $tags[] = array(
                        'tag' => 'UNKNOWN_TAG(32)'
                    );
                    break;
                default:
                    # code...
                    break;
            }
        }
        return $tags;
    }
}