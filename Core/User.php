<?php


class User
{

    private string $id_user;

    public function __construct(string $id_user) {
        $this->id_user = $id_user;
    }

    public static function isAuthenticated($email, $password)
    {
        $result = Database::table('users')->select()->where('email', "=", "'$email'")->first();

        if (!$result || password_verify($password, $result['password']) === false) {
            return false;
        }

        return $result;
    }



    public static function login($email, $password)
    {
        if ($result = User::isAuthenticated($email, $password)) {
            $_SESSION['logged_in'] = true;

            $_SESSION['id_user'] = $result['id_user'];

            session_regenerate_id(true);

            Router::redirect('location:/');
        }

        echo "<h2>Account not found</h2>";
    }

    public static function verifyEmail($email)
    {
        $result = Database::table('users')->select('email')->where('email', "=", "'$email'")->first();
        if (!$result) {
            return false;
        }
        return $result;
    }


    public static function register($email, $password)
    {
        //validate details
     Database::table('users')->store(['email' => "$email", 'password' => "$password"]);;
    }

    public static function reset($email, $newPassword)
    {
        //update password of that user
        Database::table("users")->updatePassword($email, password_hash($newPassword, PASSWORD_BCRYPT));
    }

    public static function logout()
    {
        unset($_SESSION['logged_in']);
        unset($_SESSION['id_user']);

        //delete session cookie
        setcookie(session_name(), '', time() - 3600);
    }

    public function products() {
        return Database::table("products")->where("user_d","=",$this->id_user)->get();
    }
}
