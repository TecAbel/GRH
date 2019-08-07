<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>GRH | Login</title>
</head>
<body>
    <div class="hero">
        <div class="contenedor-hero">
            <h1>Generador de Reporte de Honorarios</h1>
        </div>
    </div>
    <div class="contenedor">
        <h3>Inicie sesión</h3>
        <form method="POST">
            <div class="contenedor-campos">
                <div class="importante">
                    Tu mejor manera de cobrar
                </div>
                <div class="campo w-100">
                    <label for="txtUsuario">Usuario: </label>
                    <input type="text" placeholder="ejemplo@mail.com" id="txtUsuario" name="txtUsuario" required>
                </div>
                <div class="campo w-100">
                    <label for="txtPass">Contraseña: </label>
                    <input type="password" id="txtPass" name="txtPass" required>
                </div>
                <div class="guardar">
                    <!--<input type="submit" name="btnEntrar" value="Entrar" class="boton">-->
                    <a class="boton" href="menu-principal.php">Entrar</a>
                </div>
                <div class="guardar">
                    <!--<input type="submit" name="btnEntrar" value="Entrar" class="boton">-->
                    <a class="boton" href="registro-usuario.php">Regístrate</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>