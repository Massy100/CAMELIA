<?php

include_once URl_APP . '/views/custom/header.php';

include_once URl_APP . '/views/custom/navbar.php';

?>

<body>
    <header>
        <nav class="navbar">
            <span class="hamburger-btn material-symbols-rounded">menu</span>
            <a href="#" class="logo">
                <img src="../../public/images/logo_camelia.jpg" alt="logo">
                <h2>CAMELIA</h2>
            </a>
            <ul class="links">
                <span class="close-btn material-symbols-rounded">close</span>
            </ul>
            <button class="login-btn">LOG IN</button>
        </nav>
    </header>
    <?php if (isset($_SESSION['usuarioError'])): ?>
        <div class="alert alert-danger alert-dismissible fade show mt-2 mb-2" role="alert">
            <?php echo $_SESSION['usuarioError'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['usuarioError']); endif ?>

    <?php if (isset($_SESSION['loginComplete'])): ?>
        <div class="alert alert-sucess alert-dismissible fade show mt-2 mb-2" role="alert">
            <?php echo $_SESSION['loginComplete'] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php unset($_SESSION['loginComplete']); endif ?>

    <div class="blur-bg-overlay"></div>
    <div class="form-popup">
        <span class="close-btn material-symbols-rounded">close</span>
        <div class="form-box login">
            <div class="form-details">
                <h2>Bienvenid@ de nuevo</h2>
                <p>Inicie sesión con su información personal para mantenerse conectado con nosotros.</p>
            </div>
            <div class="form-content">
                <h2>Iniciar sesión</h2>
                <form action="<?php echo URL_PROJECT ?>/home/login" method="POST">
                    <div class="input-field">
                        <input name="emailLogin" type="text" required>
                        <label>Email</label>
                    </div>
                    <div class="input-field">
                        <input name="passwordLogin" type="password" required>
                        <label>Contraseña</label>
                    </div>
                    <a href="#" class="forgot-pass-link">¿Olvidó su contraseña?</a>
                    <button type="submit">Ingresar</button>
                </form>
                <div class="bottom-link">
                    ¿No tiene cuenta?
                    <a href="#" id="signup-link">Registrarse</a>
                </div>
            </div>
        </div>
        <div class="form-box signup">
            <div class="form-details">
                <h2>Crear Cuenta</h2>
                <p>Inicie sesión con su información personal para mantenerse conectado con nosotros.</p>
            </div>
            <div class="form-content">
                <h2>Registrarse</h2>
                <form action="<?php echo URL_PROJECT ?>/app/home/login" method="POST">
                    <div class="input-field">
                        <input name="emailRegister" type="text" required>
                        <label>Ingresar su email</label>
                    </div>
                    <div class="input-field">
                        <input name="passwordRegister" type="password" required>
                        <label>Crear contraseña</label>
                    </div>
                    <div class="policy-text">
                        <input name="accept" type="checkbox" id="policy">
                        <label for="policy">
                            Estoy de acuerdo
                            <a href="#" class="option">Términos y Condiciones</a>
                        </label>
                    </div>
                    <button type="submit">Registrarse</button>
                </form>
                <div class="bottom-link">
                    ¿Ya tiene cuenta?
                    <a href="#" id="login-link">Iniciar sesión</a>
                </div>
            </div>
        </div>
    </div>
</body>
<?php

include_once URl_APP . '/views/custom/footer.php';

?>