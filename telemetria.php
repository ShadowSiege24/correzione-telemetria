<?php 
    
    function contaPacchettiPersi($ping_grezzi){
        $pacchetti_persi = 0;

        foreach($ping_grezzi as $ping){
            if($ping == -1){
                $pacchetti_persi++;
            }
        }

        return $pacchetti_persi;
    }

    function pacchettiValidi($ping_grezzi){
        $ping_validi = [];

        foreach($ping_grezzi as $ping){
            if($ping >= 0){
                $ping_validi[] = $ping;
            }
        }

        return $ping_validi;
    }

    function calcolaTempoMedio($ping_validi){
        $somma = 0;
        $conteggio = 0;
        $media = 0;

        foreach($ping_validi as $ping){
            $somma += $ping;
            $conteggio++;
        }

        $media = $somma / $conteggio;

        return round($media, 2);
    }
    

    function calcolaMinMax($ping_validi, &$ping_min, &$ping_max){
        $ping_min = $ping_validi[0];
        $ping_max = $ping_validi[0];
        
        foreach ($ping_validi as $ping) {
            if($ping > $ping_max) $ping_max = $ping;
            elseif($ping < $ping_min) $ping_min = $ping;
            
        }
    }
    
    
    
    $ping_grezzi = [45, 120, -1, 32, 210, 85, -1, 18, 95, 310, 45, 60, -1, 150, 28, 240,18, 72]; 
    array_push($ping_grezzi, 55, 190, 12);

    $ping_validi = pacchettiValidi($ping_grezzi);
    $pacchetti_persi = contaPacchettiPersi($ping_grezzi);
    $tempo_medio = calcolaTempoMedio($ping_validi);
    $ping_max = 0;
    $ping_min = 0;

    calcolaMinMax($ping_validi, $ping_min, $ping_max);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <li>Totale Rilevazioni: <?= count($ping_grezzi); ?></li>
        <li>Pacchetti Validi: <?= count($ping_validi); ?></li>
        <li>Pachetti Persi: <?= $pacchetti_persi; ?></li>
        <li>Media: <?= $tempo_medio; ?></li>
        <li>Minimo: <?= $ping_min; ?></li>
        <li>Massimo: <?= $ping_max; ?></li>
    </ul>

    <table>
        <thead>
            <tr>
                <th> #         </th>
                <th> Ping (ms) </th>
                <th> Stato     </th>
            </tr>
        </thead>
        <tbody>
            <?php for ( $i = 0; $i < count($ping_validi) ; $i++): ?>
                <tr>
                    <td> <?= $i + 1; ?> </td>
                    <td> <?= $ping_validi[$i]; ?> </td>
                    <td> <?= $ping_validi[$i] >= 150 ? "CRITICO" : "NORMALE" ?> </td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</body>
</html>