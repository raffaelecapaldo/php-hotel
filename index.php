<?php

$hotels = [

    [
        'name' => 'Hotel Belvedere',
        'description' => 'Hotel Belvedere Descrizione',
        'parking' => true,
        'vote' => 4,
        'distance_to_center' => 10.4
    ],
    [
        'name' => 'Hotel Futuro',
        'description' => 'Hotel Futuro Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 2
    ],
    [
        'name' => 'Hotel Rivamare',
        'description' => 'Hotel Rivamare Descrizione',
        'parking' => false,
        'vote' => 1,
        'distance_to_center' => 1
    ],
    [
        'name' => 'Hotel Bellavista',
        'description' => 'Hotel Bellavista Descrizione',
        'parking' => false,
        'vote' => 5,
        'distance_to_center' => 5.5
    ],
    [
        'name' => 'Hotel Milano',
        'description' => 'Hotel Milano Descrizione',
        'parking' => true,
        'vote' => 2,
        'distance_to_center' => 50
    ],

];


//Dichiario array filtrato
$filteredHotels = [];

//Se c'è parking impostato in GET
if (!empty($_GET['parking']) && $_GET['parking'] == 'yes') {
    foreach ($hotels as $hotel) { //Per ogni hotel
        if ($hotel['parking']) { //se ha parking true
            $filteredHotels[] = $hotel; //inseriscilo nell'array filtered
        }
    }
} else {
    $filteredHotels = $hotels; //altrimenti mostra tutto

}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <title>Hotel</title>
</head>

<body>
    <header>
        <h1 class="text-center">Hotel del posto</h1>
        <div class="filters w-75 mx-auto mb-3">
            <form class="d-flex align-items-center" method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <label for="parking">Parcheggio</label>

                <select name="parking" class="form-select w-25 ms-2">
                    <option <?php echo !empty($_GET['parking']) ?  ($_GET['parking'] == 'yes' ? 'selected' : '') : '' ?> value="yes">SI</option>
                    <option <?php echo !empty($_GET['parking']) ? ($_GET['parking'] == 'no' ? 'selected' : '') : '' ?> value="no">NO</option>
                </select>
                <button type="submit" class="btn btn-primary ms-2">Filtra</button>


            </form>

        </div>
    </header>
    <main>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Descrizione</th>
                    <th scope="col">Parcheggio</th>
                    <th scope="col">Stelle</th>
                    <th scope="col">Distanza dal centro</th>


                </tr>
            </thead>
            <tbody>
                <?php foreach ($filteredHotels as $hotel) { ?>
                    <tr>
                        <td><?php echo $hotel["name"] ?></td>
                        <td><?php echo $hotel["description"] ?></td>
                        <td><?php echo ($hotel["parking"] ? 'SI' : 'NO') ?></td>
                        <td><?php echo $hotel["vote"] ?></td>
                        <td><?php echo $hotel["distance_to_center"] ?> km</td>
                    </tr>
                <?php } ?>


            </tbody>
        </table>
    </main>
</body>