@extends('layouts.dashboard')

@section('content')
    <h3>Benvenuto nelle tue statistiche</h3>

    {{-- {{ dd($dishes) }} --}}

    

    <?php
       $data = []; 

       foreach($dishes as $dish) {
           $data[] = $dish->name;
       }

       $encoded = json_encode($data);
    ?>

    


    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
    const ctx = document.getElementById('myChart').getContext('2d');
    
    var encoded = '<?=$encoded?>';
    var data = JSON.parse(encoded);

    let myPlates = [];
    data.forEach(element => {
        myPlates.push(element);
    });


    let myOrders = [4, 12, 8, 5, 2, 3];

    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: myPlates,
            datasets: [{
                label: 'n° di prenotazioni',
                data: myOrders,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
@endsection