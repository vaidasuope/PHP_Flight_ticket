<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width-device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skrydžio bilietas</title>
    <link rel="stylesheet" href="view/css/bootstrap.min.css"
</head>

<body>
<div class="container">

    <?php if (isset($_POST['print'])): ?>
        <?php validate();?>
    <?php endif; ?>

    <?php if (isset($_POST['send'])): ?>
    <div class="container">
        <h1 class="mb-5 mt-2 bg-light text-center">Skrydžių rezervacijos</h1>

        <form method="post">
            <div class="row mb-3">
                <h4 class="col-4 bg-light">Filtruoti pagal skrydžio numerį:</h4>
                <select class="col-5 form-control" name="numeris" id="number" aria-label="fault select example">
                    <option class="selected">Pasirinkite skrydžio numerį</option>
                    <?php foreach ($flights as $flight): ?>
                        <option value="<?= $flight; ?>"><?= $flight; ?></option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" name="search" id="search" class="btn btn-dark">Ieškoti</button>
            </div>
        </form>

        <div class="row">
            <table class="table table-hover">
                <thead class="thead-dark text-center align-items-center">
                <tr>
                    <th>Skrydžio nr.</th>
                    <th>Asmens kodas</th>
                    <th class="align-items-center">Vardas</th>
                    <th>Pavardė</th>
                    <th>Telefono nr.</th>
                    <th>El. paštas</th>
                    <th>Išvykimas</th>
                    <th>Atvykimas</th>
                    <th>Bagažas</th>
                    <th>Kaina</th>
                    <th>Pastabos</th>
                </tr>
                </thead>
                <tbody>
                <?php printTable();?>
                </tbody>
            </table>
        </div>
        <?php die();?>
        <?php endif;?>

        <?php if (isset($_POST['search'])): ?>
        <div class="container">
            <h1 class="mb-5 mt-2 bg-light text-center">Skrydžių rezervacijos</h1>

            <form method="post">
                <div class="row mb-3">
                    <h4 class="col-4 bg-light">Filtruoti pagal skrydžio numerį:</h4>
                    <select class="col-5 form-control" name="numeris" id="number" aria-label="fault select example">
                        <option class="selected">Pasirinkite skrydžio numerį</option>
                        <?php foreach ($flights as $flight): ?>
                            <option value="<?= $flight; ?>"><?= $flight; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" name="search" id="search" class="btn btn-dark">Ieškoti</button>
                </div>
            </form>

            <div class="row">
                <table class="table table-hover">
                    <thead class="thead-dark text-center align-items-center">
                    <tr>
                        <th>Skrydžio nr.</th>
                        <th>Asmens kodas</th>
                        <th class="align-items-center">Vardas</th>
                        <th>Pavardė</th>
                        <th>Telefono nr.</th>
                        <th>El. paštas</th>
                        <th>Išvykimas</th>
                        <th>Atvykimas</th>
                        <th>Bagažas</th>
                        <th>Kaina</th>
                        <th>Pastabos</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php filter();?>
                    </tbody>
                </table>
            </div>
            <?php die();?>
            <?php endif;?>

    <?php if (isset($_POST['print']) && empty($validation)): ?>
    <?php readData();?>
        <div class="table-bordered container mt-5">
            <div class="row bg-light mb-2 justify-content-center">
                <h3>Your Flight Ticket</h3>
            </div>
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="row">
                        <h3 class="col-4"><?= $_POST ['skrydis'] ?></h3>
                        <div class="col">
                            <div class="col-12"><span class="font-weight-bold">From: </span><?= $_POST ['išvykimas'] ?>
                            </div>
                            <div class="col-12"><span class="font-weight-bold">To: </span><?= $_POST ['atvykimas'] ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-4">
                            <img src="https://www.flaticon.com/svg/vstatic/svg/2979/2979504.svg?token=exp=1611048417~hmac=e92148b8948bdf3f532c16668f3526cb"
                                 height="100px" width="100px">
                        </div>
                        <div class="col">
                            <div class="row">
                                <p class="col-12"><span class="font-weight-bold">Passenger: </span><?= $_POST ['vardas'] ?> <?= $_POST ['pavardė'] ?></p>
                                <p class="col-12"><span class="font-weight-bold">Code: </span><?= $_POST ['kodas'] ?></p>
                                <p class="col-12"><span class="font-weight-bold">Luggage weight: </span><?= $_POST ['bagažas']?><span> kg</span>
                                <p class="col-12"><span class="font-weight-bold">Pastabos: </span><?= $_POST ['pastabos']?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col bg-light">
                    <h6 class="mt-5">Overview:</h6>
                    <p class="font-weight-bold">Travel: 1 adult</p>
                    <p><span class="font-weight-bold">Flight </span><?= $_POST ['kaina'] ?> eur</p>
                    <?php
                    $weight = $_POST['bagažas'];
                    $price = $_POST ['kaina'];
                    if ($weight > 19): ?>
                        <p><span class="font-weight-bold">Luggage: </span> 30 eur</p>
                        <h5>Total price: <?= $price + 30; ?> eur</h5>
                    <?php else: ?>
                        <h5>Total price: <?= $price ?> eur</h5>
                    <?php endif; ?>

                </div>
            </div>
        </div>


    <?php else: ?>

        <?php foreach ($validation as $errors): ?>
            <div class="alert-danger m-2" role="alert">
                <?= $errors; ?>
            </div>
        <?php endforeach; ?>

        <form method="post" class="mb-5">
            <h1 class="mb-5 mt-3 bg-light text-center">Jūsų skrydžio informacija</h1>
            <div class="row">
            <div class="form-group col-6">
                <label for="name">Skrydžio numeris:</label>
                <select class="form-control" name="skrydis" id="flight" aria-label="fault select example" name>
                    <option selected>Pasirinkite skrydžio numerį</option>
                    <?php for ($i = 0; $i < count($flights); $i++): ?>
                        <option><?= ucfirst($flights[$i]) ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group col">
                <label for="lastname">Asmens kodas:</label>
                <input type="text" name="kodas" id="code" class="form-control">
            </div>
            </div>
            <div class="row">
            <div class="form-group col-6">
                <label for="email">Vardas:</label>
                <input type="text" name="vardas" id="name" class="form-control">
            </div>
            <div class="form-group col">
                <label for="message">Pavardė:</label>
                <input type="text" name="pavardė" id="lastname" class="form-control">
            </div>
            </div>
            <div class="row">
            <div class="form-group col-6">
                <label for="message">Telefono numeris:</label>
                <input type="text" name="telefonas" id="phone" class="form-control">
            </div>
            <div class="form-group col">
                <label for="message">El. paštas:</label>
                <input type="text" name="paštas" id="email" class="form-control">
            </div>
            </div>
            <div class="row">
            <div class="form-group col-6">
                <label for="message">Išvykimas:</label>
                <select class="form-control" name="išvykimas" id="departure" aria-label="fault select example" name>
                    <option selected>Pasirinkite oro uostą</option>
                    <?php for ($i = 0; $i < count($departure); $i++): ?>
                        <option><?= ucfirst($departure[$i]) ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group col">
                <label for="message">Atvykimas:</label>
                <select class="form-control" name="atvykimas" id="arrival" aria-label="fault select example" name>
                    <option selected>Pasirinkite oro uostą</option>
                    <?php for ($i = 0; $i < count($arrival); $i++): ?>
                        <option><?= ucfirst($arrival[$i]) ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            </div>
            <div class="row">
            <div class="form-group col-6">
                <label for="message">Bagažas (kg):</label>
                <select class="form-control" name="bagažas" id="baggage" aria-label="fault select example" name>
                    <option selected>Pasirinkite bagažo svorį</option>
                    De
                    <?php for ($i = 0; $i < count($luggage); $i++): ?>
                        <option><?= ucfirst($luggage[$i]) ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="form-group col">
                <label for="message">Kaina:</label>
                <input type="text" name="kaina" id="price" class="form-control">
            </div>
            </div>
            <div class="form-group">
                <label for="message">Pastabos:</label>
                <input type="text" name="pastabos" id="comments" class="form-control">
            </div>
            <div class="form-group d-flex justify-content-center">
            <button type="submit" name="print" id="print" class="mt-3 mr-3 btn btn-primary btn-lg text-center">Spausdinti bilietą</button>
            <button type="submit" name="send" id="send" class="mt-3 btn btn-dark btn-lg text-center">Skrydžių rezervacijos</button>
            </div>
        </form>
    <?php endif; ?>

</div>


<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>

</body>
</html>
