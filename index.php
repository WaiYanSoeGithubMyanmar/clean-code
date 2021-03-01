<?php

declare(strict_types=1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php

    # 1. Don't add unneeded context

    #  Bad
    class BadCar
    {
        public $carMake;
        public $carModel;
    }

    #  Good
    class GoodCar
    {
        public  $make;
        public $model;
    }


    # 2. Function Arguments(2 or fewer ideally)

    # Bad
    function createBadMenu($title, $body)
    {
    }

    # Good
    class MenuConfig
    {
        public $title;
        public $body;
        public $buttonText;
        public $cancellabel = false;
    }

    $config = new MenuConfig();

    $config->title = 'Foo';
    $config->body = "Bar";
    $config->buttonText = "Baz";
    $config->cancellabel = true;


    function createMenu(MenuConfig $config)
    {
        foreach ($config as $c) {
            echo $c . '<br>';
        }
    }
    createMenu($config);



    # 3. Functions Should Do One Thing

    #Bad

    function bademailClients($clients)
    {
        foreach ($clients as $client) {
            $db = (object) array('find' => ''); // for test

            $clientRecord = $db->find($client);

            if ($clientRecord->isActive()) {
                //email($clients)
                //....
            }
        }
    }

    #Good

    function emailClients($client)
    {
        $activeClients = activeClients($client);
        array_walk($activeClients, 'email');
    }

    function activeClients($client)
    {
        return array_filter($client, 'isClientActive');
    }

    function isClientActive($client)
    {
        $db = (object) array('find' => ''); // for test
        $clientRecord = $db->find($client);
        return $clientRecord->isActive();
    }


    # 4. Use the same vocabulary for the same type of variable

    #Bad

    // getUserInfo();
    // getUserData();
    // getUserRecord();


    #God

    // getUser();



    # 5. User searchable names(p1)

    #Bad

    // What the heck is 448 for?
    $result = $serializer->serialize($data, 448);


    #Good

    $json = $serializer->serialize($data, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);


    # 6. User searchable names (p1)

    #Bad

    class User
    {
        // What the heck is 7 for?
        public $access = 7;
    }

    // What the heck is 4 for?
    if ($user->access & 4) {
        // ...
    }

    // What's going on here?
    $user->access ^= 2;


    #Good

    class Person
    {
        public const ACCESS_READ = 1;
        public const ACCESS_CREATE = 2;
        public const ACCESS_UPDATE = 4;
        public const ACCESS_DELETE = 8;

        //User as default can read, create and update something
        public $access = self::ACCESS_READ | self::ACCESS_CREATE | self::ACCESS_UPDATE;
    }

    if ($user->access & Person::ACCESS_UPDATE) {
    }


    # 7. Use Explantory variables

    #Bad

    $address = 'One infinite Loop, Cupertino 95014';
    $cityZipCodeRegax = '/^[^,]+,\s*(.+?)\s*(\d{5})$/';
    preg_match($cityZipCodeRegax, $address, $matches);

    //saveCityZipCode($matches[1], $matches[2])


    #Not  Bad

    $address = 'One Infinite Loop, Cupertino 95014';
    $cityZipCodeRegex = '/^[^,]+,\s*(.+?)\s*(\d{5})$/';
    preg_match($cityZipCodeRegex, $address, $matches);

    [, $city, $zipCode] = $matches;
    // saveCityZipCode($city, $zipCode);

    #Good
    $address = 'One Infinite Loop, Cupertino 95014';
    $cityZipCodeRegex = '/^[^,]+,\s*(.+?)\s*(\d{5})$/';
    preg_match($cityZipCodeRegex, $address, $matches);

    // saveCityZipCode($matches['city'], $matches['zipCode']);




    ?>


</body>

</html>