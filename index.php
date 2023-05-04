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

if (isset($_GET['parking']) && isset($_GET['stars'])) { //Se ci sono entrambi i parametri
    if ($_GET['parking'] == 'yes') { // se parking è su yes
        foreach ($hotels as $hotel) { //Per ogni hotel
            if ($hotel['vote'] >= $_GET['stars'] && $hotel['parking']) { //Aggiungi solo quelli col voto corrispondente alla scelta e con parking a true
                $filteredHotels[] = $hotel;
            }
        }
    } else { //Se parking è a no
        foreach ($hotels as $hotel) { //Per ogni hotel
            if ($hotel['vote'] >= $_GET['stars'] && !$hotel['parking']) { //Aggiungi solo quelli col voto corrispondente alla scelta e con parking a false
                $filteredHotels[] = $hotel;
            }
        }
    }
} else if (!isset($_GET['parking']) && isset($_GET['stars'])) { //se c'è solo parking
    if ($_GET['parking'] == 'yes') { // se parking è su yes
        foreach ($hotels as $hotel) { //Per ogni hotel
            if ($hotel['parking']) { //Aggiungi solo quelli con parking true
                $filteredHotels[] = $hotel;
            }
        }
    } else {
        $filteredHotels[] = $hotel; //Altrimenti non cambia nulla
    }
} else if (isset($_GET['parking']) && !isset($_GET['stars'])) { //Se c'è solo stars
    foreach ($hotels as $hotel) { //Per ogni hotel
        if ($hotel['vote'] >= $_GET['stars']) { //Aggiungi solo quelli col voto corrispondente alla scelta
            $filteredHotels[] = $hotel;
        }
    }
} else { //Se non c'è nessun parametro in get
    $filteredHotels = $hotels; // mostra tutto

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
        <div class="filters  ms-2 mb-3">
            <form class="d-flex align-items-center justify-content-center" method="get" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div class="parking-filter d-flex align-items-center">
                    <label for="parking">Parcheggio</label>

                    <select name="parking" class="form-select w-100 ms-2 me-2">
                        <option <?php echo !empty($_GET['parking']) ?  ($_GET['parking'] == 'yes' ? 'selected' : '') : '' ?> value="yes">SI</option>
                        <option <?php echo !empty($_GET['parking']) ? ($_GET['parking'] == 'no' ? 'selected' : '') : '' ?> value="no">NO</option>
                    </select>
                </div>
                <div class="stars-filter ms-1 d-flex align-items-center" style="width: 180px">
                    <label for="stars" style="width: 200px">Stelle minime:</label>


                    <select name="stars" class="form-select w-50 ms-2">
                        <option <?php echo !empty($_GET['stars']) ?  ($_GET['stars'] == '1' ? 'selected' : '') : '' ?> value="1">1</option>
                        <option <?php echo !empty($_GET['stars']) ? ($_GET['stars'] == '2' ? 'selected' : '') : '' ?> value="2">2</option>
                        <option <?php echo !empty($_GET['stars']) ? ($_GET['stars'] == '3' ? 'selected' : '') : '' ?> value="3">3</option>
                        <option <?php echo !empty($_GET['stars']) ? ($_GET['stars'] == '4' ? 'selected' : '') : '' ?> value="4">4</option>
                        <option <?php echo !empty($_GET['stars']) ? ($_GET['stars'] == '5' ? 'selected' : '') : '' ?> value="5">5</option>

                    </select>
                </div>
                <div class="buttons">
                    <button type="submit" class="btn btn-primary ms-4">Filtra</button>
                    <button id="reset" class="btn btn-primary ms-4">Reset</button>
                </div>


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

        <?php if (!$filteredHotels) { ?>
            <h3 class="text-center">Nessun risultato trovato</h3>
        <?php } ?>


    </main>
    <script src="script.js"></script>
</body>