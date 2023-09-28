<?php

const ROOT = __DIR__;

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    define('BASE_URI', substr(__DIR__,
    strlen($_SERVER['DOCUMENT_ROOT'])));

    require_once(implode(DIRECTORY_SEPARATOR, ['application', 'autoload.php']));

    $app = new MyFramework\Core();
    $app->run();

?>

<!DOCTYPE html>

    <html lang="en">

        <head>
            <meta charset="UTF-8">
            <title>MyFramework</title>
        </head>

        <body>

        <pre>
            $_POST:
            <?php print_r($_POST); ?>

            $_GET:
            <?php print_r($_GET); ?>

            $_SERVER:
            <?php print_r($_SERVER); ?>
        </pre>

        <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" method="post">

            <div>
                <label for="login">Login:</label>
                <input type="text" id="login" name="login">
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
            </div>

            <div>
                <button type="submit">Envoyer</button>
            </div>

        </form>

        </body>

    </html>