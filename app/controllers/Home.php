<?php

class Home extends Controller
{
    public $usuario;
    public $materia;

    public function __construct()
    {
        $this->usuario = $this->model('usuario');
        $this->materia = $this->model('materia');
    }

    public function index()
    {
        if (isset($_SESSION['logueado'])) {
            $datosUsuario = $this->usuario->getUsuario($_SESSION['usuario']);
            $this->view('pages/homepage', $datosUsuario);
        } else {
            $this->view('pages/login');
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datosLogin = [
                'email' => trim($_POST['emailLogin']),
                'password' => trim($_POST['passwordLogin'])
            ];

            $datosUsuario = $this->usuario->getUsuario($datosLogin['email']);

            if ($this->usuario->verificarContrasena($datosUsuario, $datosLogin['password'])) {
                if (property_exists($datosUsuario, 'privilegio')) {
                    $_SESSION['logueado'] = $datosUsuario->privilegio;
                    $this->view('pages/homepage');
                } else {
                    $this->view('pages/homepage');
                }


            } else {
                $_SESSION['errorLogin'] = 'El usuario o la contraseña son incorrectos';
                redirection('/app/home/login');
            }

        } else {
            if (isset($_SESSION['logueado'])) {
                redirection('/app/pages/homepage');
            } else {
                $this->view('pages/login');
            }
        }

    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datosRegistro = [
                'privilegio' => '1',
                'email' => trim($_POST['emailRegister']),
                'password' => password_hash(trim($_POST['passwordRegister']), PASSWORD_DEFAULT)
            ];
            if ($this->usuario->verificarUsuario($datosRegistro)) {
                if ($this->usuario->register($datosRegistro)) {
                    $_SESSION['loginComplete'] = 'Tu registro se ha completado satisfactoriamente';
                    redirection('/app/home/login');
                } else {
                }
            } else {
                $_SESSION['usuarioError'] = 'Ese correo electronico ya posee una cuenta';
                $this->view('pages/login');
            }
        } else {
            if (isset($_SESSION['logueado'])) {
                redirection('/app/pages/homepage');
            } else {
                $this->view('pages/login');
            }
        }
    }

    public function logout()
    {
        session_start();

        $_SESSION = [];

        session_destroy();

        $this->view('pages/login');
    }

    public function registar_info()
    {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $datosMateria = [
                'materia' => trim($_POST['materia']),
                'horas' => trim($_POST['horas'])
            ];

            $this->materia->register($datosMateria);
        } else {
            echo "Error: No se recibieron datos del formulario.";

        }
    }
}
