<?php

$validation = [];

function validate()
{

    global $validation;
    if (!preg_match('/^[A-Za-zŠšĖėŽž]{1,100}$/', $_POST['vardas'])) {
        $validation[] = "Netesingai įvestas/per ilgas vardas.";
    }
    if (!preg_match('/^[A-Za-zŠšĖėŽž]{1,100}$/', $_POST['pavardė'])) {
        $validation[] = "Netesingai įvesta/per ilga pavardė.";
    }
    if (!preg_match('/^(\+3706)([0-9])/', $_POST['telefonas'])) {
        $validation[] = "Telefono numeris neatitinka formato";
    }
    if (!preg_match('/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/', $_POST['paštas'])) {
        $validation[] = "El. paštas neatitinka formato.";
    }
    if (!preg_match('/^\d{1,4}+(:?[.]\d{1,2})$/', $_POST['kaina'])) {
        $validation[] = 'Kaina neatitinka formato. Rašykite su "."';
    }
    if (!preg_match('/^[A-Za-z0-9,.]{0,500}$/', $_POST['pastabos'])) {
        $validation[] = "Žinutė per ilga (iki 500 simbolių)!";
    }
}

function readData()
{
    $data = 'data/flights.txt';
    $content = file_get_contents($data);
    $formData = implode(',', $_POST);
    $content .= $formData . "/n";
    file_put_contents($data, $content);
}

function printTable()
{

    $messages = file_get_contents('data/flights.txt', true);
    $messages = explode('/n', $messages);

    foreach ($messages as $message) {
        echo "<tr></tr>";
        $messageAfter = explode(',', $message);
        foreach ($messageAfter as $value) {
            if ($value != $_POST ['send']) {
                echo "<td>$value</td>";
            }
        }
    }
}

//function option (){
//    $messages = file_get_contents('data/flights.txt', true);
//    $messages = explode('/n', $messages);
//
//    foreach ($messages as $message) {
//        echo "<tr></tr>";
//        $messageAfter = explode(',', $message);
//        if ($message != $_POST ['send']) {
//            echo "<option>$messageAfter[0]</option>";
//        }
//    }
//}

function filter()
{
    $messages = file_get_contents('data/flights.txt', true);
    $messages = explode('/n', $messages);

    $all = true;
    foreach ($messages as $message) {
        echo "<tr></tr>";
        $messageAfter = explode(',', $message);
        foreach ($messageAfter as $value) {
            if ($value != $_POST ['search'] && $_POST['numeris'] == $messageAfter[0]) {
                echo "<td>$value</td>";
                $all = false;
            } elseif ($value != $_POST ['search'] && $_POST['numeris'] == "Pasirinkite skrydžio numerį") {
                echo "<td>$value</td>";
                $all = false;
            }
        }
    }
    if ($all) {
        echo '<script>alert("Toks skrydis dar neužregistruotas!")</script>';
    }

}

