@php
    $price = $customerRecord->price;
    $created_at = $customerRecord->created_at;

    // Ensure $price is numeric
    if (is_numeric($price)) {
        $price = floatval($price);

        // Get current time and calculate the time difference
        $current_time = new DateTime('now', new DateTimeZone('Asia/Karachi'));
        $event_time = new DateTime($created_at, new DateTimeZone('Asia/Karachi'));

        // Calculate the time difference in seconds
        $time_difference_in_seconds = $event_time->getTimestamp() + 2 * 60 * 60 - $current_time->getTimestamp();

        // Apply $100 discount if within 2 hours
        if ($time_difference_in_seconds > 0) {
            $price -= 100;
            $price = max(0, $price); // Ensure price is not negative
        }
    } else {
        $time_difference_in_seconds = 0; // Prevent JavaScript issues
        echo 'Invalid price data.';
        exit();
    }
@endphp



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment Method</title>
    <link rel="icon" href="{{ url('public/favicon.ico') }}" type="image/png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<style>
    /* Center the entire timer-box */
    .timer-box {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        /* Adds space between each span */
        font-size: 24px;
        color: #fff;
        margin-bottom: 15px;
    }

    /* Individual time units (span) styling */
    .timer-box span {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #8fd13f;
        border-radius: 8px;
        padding: 10px 15px;
        min-width: 60px;
        /* Ensure all time units have equal width */
    }

    /* Button group centering */
    .btn-group {
        text-align: center;
    }

    .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        margin: 5px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #5856d6;
        color: white;
    }

    .btn-outline-primary {
        background-color: transparent;
        border: 1px solid #5856d6;
        color: #5856d6;
    }
</style>


<body class="bg-dark">

    <div class="container">
        <div class="row text-center mt-5 justify-content-center align-items-center">

            <h1 class="text-white">Payment Method</h1>




            <div class="timer-box mt-2">
                <span id="days">00</span> :
                <span id="hours">00</span> :
                <span id="minutes">00</span> :
                <span id="seconds">00</span>
            </div>


            <p class="text-white">Left to avail 100$ discount 💸</p>
            <div class="btn-group mt-2 justify-content-center">


                <div class="btn-group mt-3 justify-content-center">

                    <form action="checkout" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="price" value="{{ $price }}">
                        <input type="hidden" name="id" value="{{ $customerRecord->id }}">
                        <button type="submit" class="btn btn-primary me-2">Stripe Payment</button>
                    </form>

                    {{--  <form action="{{ route('finance') }}" method="get">
                        <button type="submit" class="btn btn-outline-primary">Finance Payment</button>
                    </form>  --}}

                </div>

            </div>

            <a href="https://decensatdesign.com/" class="mt-3">Not Now</a>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        var countdownTime = <?php echo max(0, $time_difference_in_seconds * 1000); ?>; // Ensure non-negative time
        var endTime = new Date().getTime() + countdownTime;

        function updateTimer() {
            var now = new Date().getTime();
            var distance = endTime - now;

            if (distance < 0) {
                clearInterval(timerInterval);
                document.querySelector('.timer-box').innerHTML = "Time is up!";
                return;
            }

            // Time calculations for days, hours, minutes, and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Update the timer elements
            document.getElementById("days").innerHTML = ('0' + days).slice(-2);
            document.getElementById("hours").innerHTML = ('0' + hours).slice(-2);
            document.getElementById("minutes").innerHTML = ('0' + minutes).slice(-2);
            document.getElementById("seconds").innerHTML = ('0' + seconds).slice(-2);
        }

        // Run once immediately to update the UI
        updateTimer();

        // Update the timer every 1 second
        var timerInterval = setInterval(updateTimer, 1000);
    </script>




</body>

</html>
