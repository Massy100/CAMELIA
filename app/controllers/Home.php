<?php

class Home extends Controller
{
    public $usuario;

    public function __construct()
    {
        $this->usuario = $this->model('usuario');
    }

    public function index()
    {
        $this->view('pages/login');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $datosRegistro = [
                'privilegio' => '1',
                'email' => trim($_POST['emailRegister']),
                'password' => password_hash(trim($_POST['passwordRegister']), PASSWORD_DEFAULT)
            ];
            if ($this->usuario->verificarUsuario($datosRegistro)) {
                if ($this->usuario->register($datosRegistro)) {
                    $_SESSION["usuario"] = $datosRegistro['usuario'];
                    $_SESSION['loginComplete'] = 'Tu registro se ha completado satisfactoriamente';
                    redirection('/app/home/login');
                } else {

                }
            } else {
                $_SESSION['usuarioError'] = 'Ese correo electronico ya posee una cuenta';
                $this->view('pages/login');
            }
            //if ($this->usuario->verificarUsuario($datosRegistro)) {
            /* if ($this->usuario->register($datosRegistro)) {
                
            } else {

            } */
            //} else {
            //$_SESSION['usuarioError'] = 'Ese correo electronico ya posee una cuenta';
            //$this->view('pages/login');
            //}
        } else {
            // Muestra la vista del formulario de inicio de sesión
            $this->view('pages/login');
        }

    }
}
