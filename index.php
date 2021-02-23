<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php

    //model
    class MenuConfig
    {
        public $title;
        public $body;
        public $buttonText;
        public $cancellabel = false;
    }

    //object
    $config = new MenuConfig();

    //setter
    $config->title = 'Foo';
    $config->body = "Bar";
    $config->buttonText = "Baz";
    $config->cancellabel = true;



    function createMenu(MenuConfig $config)
    {
        foreach ($config as $c) {
            echo $c . "<br>";
        }
    }

    createMenu($config);

    ?>


</body>

</html>