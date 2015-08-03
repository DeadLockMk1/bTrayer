<?php
/**
 * Yii-User module.
 *
 * @author Mikhail Mangushev <mishamx@gmail.com>
 *
 * @link http://yii-user.2mx.org/
 *
 * @license http://www.opensource.org/licenses/bsd-license.php
 *
 * @version $Id: UserModule.php 132 2011-10-30 10:45:01Z mishamx $
 */
class UserModule extends CWebModule
{
    /**
     * @var int
     * @desc items on page
     */
    public $user_page_size = 10;

    /**
     * @var int
     * @desc items on page
     */
    public $fields_page_size = 10;

    /**
     * @var string
     * @desc hash method (md5,sha1 or algo hash function http://www.php.net/manual/en/function.hash.php)
     */
    public $hash = 'md5';

    /**
     * @var boolean
     * @desc use email for activation user account
     */
    public $sendActivationMail = true;

    /**
     * @var boolean
     * @desc allow auth for is not active user
     */
    public $loginNotActiv = false;

    /**
     * @var boolean
     * @desc activate user on registration (only $sendActivationMail = false)
     */
    public $activeAfterRegister = false;

    /**
     * @var boolean
     * @desc login after registration (need loginNotActiv or activeAfterRegister = true)
     */
    public $autoLogin = true;

    public $registrationUrl = array("/user/registration");
    public $recoveryUrl = array("/user/recovery/recovery");
    public $loginUrl = array("/user/login");
    public $logoutUrl = array("/user/logout");
    public $profileUrl = array("/user/profile");
    public $returnUrl = array("/user/profile");
    public $returnLogoutUrl = array("/user/login");

    /**
     * @var int
     * @desc Remember Me Time (seconds), defalt = 2592000 (30 days)
     */
    public $rememberMeTime = 2592000; // 30 days

    public $fieldsMessage = '';

    /**
     * @var array
     * @desc User model relation from other models
     *
     * @see http://www.yiiframework.com/doc/guide/database.arr
     */
    public $relations = array();

    /**
     * @var array
     * @desc Profile model relation from other models
     */
    public $profileRelations = array();

    /**
     * @var boolean
     */
    public $captcha = array('registration' => true);

    /**
     * @var boolean
     */
    //public $cacheEnable = false;

    public $tableUsers = '{{users}}';
    public $tableProfiles = '{{profiles}}';
    public $tableProfileFields = '{{profiles_fields}}';

    public $defaultScope = array(
            'with' => array('profile'),
    );

    private static $_user;
    private static $_users = array();
    private static $_userByName = array();
    private static $_admin;
    private static $_admins;

    /**
     * @var array
     * @desc Behaviors for models
     */
    public $componentBehaviors = array();

    public function init()
    {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application

        // import the module-level models and components
        $this->setImport(array(
            'user.models.*',
            'user.components.*',
        ));
    }

    public function getBehaviorsFor($componentName)
    {
        if (isset($this->componentBehaviors[$componentName])) {
            return $this->componentBehaviors[$componentName];
        } else {
            return array();
        }
    }

    public function beforeControllerAction($controller, $action)
    {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $str
     * @param $params
     * @param $dic
     *
     * @return string
     */
    public static function t($str = '', $params = array(), $dic = 'user')
    {
        if (Yii::t("UserModule", $str) == $str) {
            return Yii::t("UserModule.".$dic, $str, $params);
        } else {
            return Yii::t("UserModule", $str, $params);
        }
    }

    /**
     * @return hash string.
     */
    public static function encrypting($string = "")
    {
        $hash = Yii::app()->getModule('user')->hash;
        if ($hash == "md5") {
            return md5($string);
        }
        if ($hash == "sha1") {
            return sha1($string);
        } else {
            return hash($hash, $string);
        }
    }

    /**
     * @param $place
     *
     * @return boolean
     */
    public static function doCaptcha($place = '')
    {
        if (!extension_loaded('gd')) {
            return false;
        }
        if (in_array($place, Yii::app()->getModule('user')->captcha)) {
            return Yii::app()->getModule('user')->captcha[$place];
        }

        return false;
    }

    /**
     * Return admin status.
     *
     * @return boolean
     */
    public static function isAdmin()
    {
        if (Yii::app()->user->isGuest) {
            return false;
        } else {
            if (!isset(self::$_admin)) {
                if (self::user()->superuser) {
                    self::$_admin = true;
                } else {
                    self::$_admin = false;
                }
            }

            return self::$_admin;
        }
    }

    /**
     * Return admins.
     *
     * @return array syperusers names
     */
    public static function getAdmins()
    {
        if (!self::$_admins) {
            $admins = User::model()->active()->superuser()->findAll();
            $return_name = array();
            foreach ($admins as $admin) {
                array_push($return_name, $admin->username);
            }
            self::$_admins = ($return_name) ? $return_name : array('');
        }

        return self::$_admins;
    }

    /**
     * Send mail method.
     */
    public static function sendMail($email, $subject, $message)
    {
        $adminEmail = Yii::app()->params['adminEmail'];
        $headers = "MIME-Version: 1.0\r\nFrom: $adminEmail\r\nReply-To: $adminEmail\r\nContent-Type: text/html; charset=utf-8";
        $message = wordwrap($message, 70);
        $message = str_replace("\n.", "\n..", $message);

        return mail($email, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $headers);
    }

    /**
     * Return safe user data.
     *
     * @param user id not required
     *
     * @return user object or false
     */
    public static function user($id = 0, $clearCache = false)
    {
        if (!$id && !Yii::app()->user->isGuest) {
            $id = Yii::app()->user->id;
        }
        if ($id) {
            if (!isset(self::$_users[$id]) || $clearCache) {
                self::$_users[$id] = User::model()->with(array('profile'))->findbyPk($id);
            }

            return self::$_users[$id];
        } else {
            return false;
        }
    }

    /**
     * Return safe user data.
     *
     * @param user name
     *
     * @return user object or false
     */
    public static function getUserByName($username)
    {
        if (!isset(self::$_userByName[$username])) {
            $_userByName[$username] = User::model()->findByAttributes(array('username' => $username));
        }

        return $_userByName[$username];
    }

    /**
     * Return safe user data.
     *
     * @param user id not required
     *
     * @return user object or false
     */
    public function users()
    {
        return User;
    }

    /**
     * Check user is guest (not authorized) or not.
     *
     * @return boolean
     */
    public static function isGuest()
    {
        return Yii::app()->user->isGuest;
    }

    /**
     * Check user is temp or not.
     *
     * @return boolean
     */
    public static function isUserTemp()
    {
        $user = self::user();
        if (empty($user)) {
            return false;
        }
        return $user->status == User::STATUS_TEMP;
    }

    /**
     * Check user is not guest and not temp.
     *
     * @return boolean
     */
    public static function isNotGuestAndUserTemp()
    {
        return (!self::isGuest() && !self::isUserTemp());
    }

    /**
     * Returns user id.
     *
     * @return integer
     */
    public static function getUserId()
    {
        return Yii::app()->user->id;
    }

    /**
     * Create and login user temp.
     */
    public static function createAndLoginUserTemp()
    {
        $sessionId = Yii::app()->getSession()->getSessionId();
        $emailDomain = '@temp.com';
        $password = '';

        $RegistrationForm = new RegistrationForm();
        $User = User::model()->findByAttributes(array('username' => $sessionId));
        if (empty($User)) {
            $RegistrationForm->username = $sessionId;
            $RegistrationForm->email = $sessionId.$emailDomain;
            $RegistrationForm->password = UserModule::encrypting($password);
            $RegistrationForm->status = User::STATUS_TEMP;

            if (!$RegistrationForm->save(false)) {
                return false;
            }

            $profile = new Profile();
            $profile->user_id = $RegistrationForm->id;
            $profile->lastname = '-';
            $profile->firstname = '-';
            $profile->save(false);

            $RegistrationForm->setDefaultTempUserAssignments($RegistrationForm->id);
        } else {
            $RegistrationForm = $User;
        }

        $identity = new UserIdentity($sessionId, $password);
        $identity->authenticate();
        Yii::app()->user->login($identity, 0);

        $sessionId = Yii::app()->getSession()->getSessionId();
        $RegistrationForm->username = $sessionId;
        $RegistrationForm->email = $sessionId.$emailDomain;
        $RegistrationForm->save(false);

        return true;
    }
}
