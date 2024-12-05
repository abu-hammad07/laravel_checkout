<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="icon" href="{{ url('public/favicon.ico') }}" type="image/png" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row mt-3 mb-5">

            <h1 class="text-center">Request Finance Payment</h1>

            <div class="col-md-6 offset-md-3 card mt-3">
                <form class="row g-3 needs-validation card-body" novalidate action="{{ route('create.payment') }}"
                    method="POST">
                    @csrf
                    <div class="col-md-12">
                        <label class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" required>
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Payment amount (in dollars or cents, <span class="text-danger">if
                                $10.00 type 1000</span>)</label>
                        <input type="number" class="form-control" name="amount" required>
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Crypto wallet address</label>
                        <input type="text" class="form-control" name="crypto_wallet" required>
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Wallet type</label>
                        <input type="text" class="form-control" name="wallet_type" required>
                        <div class="valid-feedback">Looks good!</div>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Description</label>
                        <textarea name="description" rows="6" class="form-control" required></textarea>
                        <div class="valid-feedback">Looks good!</div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Pay Now</button>
                    </div>
                </form>
            </div>

            {{--  <form action="{{ route('create.payment') }}" method="get">
                @csrf
                <button type="submit">Pay Now</button>
            </form>  --}}

        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
</body>

</html>
