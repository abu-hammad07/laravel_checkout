{{--  <?php
if (isset($_GET['price']) && $_GET['price'] != 895 && $_GET['price'] != 1395 && $_GET['price'] != '1895packagefbl' && $_GET['price'] != '1895packagedge' && $_GET['price'] != 1195 && $_GET['price'] != '1595packageom' && $_GET['price'] != '1595packagero' && $_GET['price'] != 1995 && $_GET['price'] != 2395 && $_GET['price'] != 999 && $_GET['price'] != 1) {
    // redirect 404 page
    header('Location: 404.php');
} elseif (isset($_GET['price']) && $_GET['price'] == 895) {
    $price = intval($_GET['price']);
    $title = 'x1 Launch Essentials';
    $description = 'Get your business started with a custom logo, brand identity, social media setup, and initial content to build your presence.';
} elseif (isset($_GET['price']) && $_GET['price'] == 1395) {
    $price = intval($_GET['price']);
    $title = 'x1 Build & scale';
    $description = 'Take your brand to the next level with enhanced branding, a basic website, short videos, and business consultation to fuel growth.';
} elseif (isset($_GET['price']) && $_GET['price'] == '1895packagefbl') {
    $price = 1895;
    $title = 'x1 Full brand launch';
    $description = 'Comprehensive brand development with an advanced website. social media management, and email marketing to scale quickly.';
} elseif (isset($_GET['price']) && $_GET['price'] == '1895packagedge') {
    $price = 1895;
    $title = 'x1 Digital Growth & Expansion';
    $description = 'Accelerate your digital growth and expansion with data-driven strategies and innovative solutions. We help you scale your online presence and reach new audiences effectively.';
} elseif (isset($_GET['price']) && $_GET['price'] == 1195) {
    $price = intval($_GET['price']);
    $title = 'x1 Social Media & Content';
    $description = 'Boost your online presence with tailored social media strategies and engaging content that connects with your audience. We help your brand shine across all platforms.';
} elseif (isset($_GET['price']) && $_GET['price'] == '1595packageom') {
    $price = 1595;
    $title = 'x1 Operations & Marketing';
    $description = 'Streamline your business operations and amplify growth with effective marketing strategies. We align your processes and promotions to drive efficiency and success.';
} elseif (isset($_GET['price']) && $_GET['price'] == '1595packagero') {
    $price = 1595;
    $title = 'x1 Rebranding & Optimization';
    $description = 'Revitalize your brand with our rebranding and optimization services. We refine your identity and strategies to enhance market impact and improve performance.';
} elseif (isset($_GET['price']) && $_GET['price'] == 1995) {
    $price = intval($_GET['price']);
    $title = 'x1 Market Growth & Development';
    $description = 'Unlock new opportunities with our market growth and development solutions. We help expand your business into new territories and drive sustainable success.';
} elseif (isset($_GET['price']) && $_GET['price'] == 2395) {
    $price = intval($_GET['price']);
    $title = 'x1 Market Leadership';
    $description = 'Position your brand at the forefront with our market leadership services. We craft strategies that elevate your influence and establish you as an industry leader.';
} elseif (isset($_GET['price']) && $_GET['price'] == 999) {
    $price = intval($_GET['price']);
    $title = 'x1 Market Leadership';
    $description = 'Our comprehensive web development package delivers custom-coded, scalable websites built for performance and user engagement.';
} elseif (isset($_GET['price']) && $_GET['price'] == 1) {
    $price = intval($_GET['price']);
    $title = 'x1 Market Leadership';
    $description = 'Our comprehensive web development package delivers custom-coded, scalable websites built for performance and user engagement.';
}

?>  --}}




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cart Page</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
</head>

<body class="bg-black text-white">
    <div class="container py-5">
        <header>
            <img src="assets/images/image.png" alt="" style="height: 120px" />
        </header>
        <div class="row">
            <div class="col-md-4">
                <div class="text-white p-4">
                    <h2 style="color: #B3FE66;">Cart <i class="bi bi-cart"></i></h3>
                        <hr />
                        <h3><strong>
                                {{ $title }}
                            </strong></h3>
                        <p class="fs-5">
                            {{ $description }}
                        </p>
                        <p class="mt-4 fw-bold fs-5" style="color: #B3FE66;">
                            Total
                            <span class="float-end">
                                {{ $price }}
                                <i class="bi bi-wallet"></i></span>
                        </p>
                </div>
            </div>
            <div class="col-md-6 p-4" style="min-height: 600px; border-left: 5px solid #B3FE66">

                {{--  <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?php echo $_SESSION['error'];
                        unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>  --}}

                <input type="text" hidden id="price" value="{{ $price }}" />
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Name" name="name" id="name" />
                </div>
                <div class="mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" id="email" />
                </div>
                <div class="mb-3">
                    <input class="form-control" style="width: 100%" id="phone" type="tel" name="phone" />
                </div>
                <div class="mb-4">
                    <label class="form-label">Do You Have a Figma / Wireframe?</label>
                    <div>
                        <input type="radio" id="figma" name="figma" value="Yes"
                            onclick="toggleFigmaInput(true)" />
                        <label for="yes">Yes</label>
                        <input type="radio" id="figma" name="figma" value="No" class="ms-3"
                            onclick="toggleFigmaInput(false)" />
                        <label for="no">No</label>
                    </div>
                </div>
                <div class="mb-3" id="figma-file-input" style="display:none;">
                    <input type="file" class="form-control" name="figma_file" id="figma_file" />
                </div>

                <button type="submit" class="btn btn-success w-50 text-black" onclick="user_form()"
                    style="background-color: #B3FE66;">Next</button>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JS for jQuery -->

    <!-- Include intlTelInput for phone number input -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Initialize intlTelInput for phone number formatting
        const phoneInputField = document.querySelector("#phone");
        const phoneInput = window.intlTelInput(phoneInputField, {
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        // Toggle visibility of Figma file input
        function toggleFigmaInput(show) {
            const figmaInput = document.getElementById('figma-file-input');
            figmaInput.style.display = show ? 'block' : 'none';
        }

        // Form submission handler
        function user_form() {
            // Get form values
            const name = $("#name").val().trim();
            const email = $("#email").val().trim();
            const phone = phoneInput.getNumber(); // Get formatted phone number
            const figma = $("input[name='figma']:checked").val(); // Get selected radio value
            const price = $("#price").val().trim();

            // Validate required fields
            if (!name || !email || !phone || !figma) {
                alert("Please fill out all required fields.");
                return false;
            }

            // Prepare FormData
            const formData = new FormData();
            formData.append('name', name);
            formData.append('email', email);
            formData.append('phone', phone);
            formData.append('figma', figma);
            formData.append('price', price);

            // Append CSRF token
            formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

            // Append Figma file if available
            const figmaFile = $('#figma_file')[0]?.files[0];
            if (figmaFile) {
                formData.append('figma_file', figmaFile);
            }

            // AJAX request
            $.ajax({
                url: "customer-event",
                type: "POST",
                data: formData,
                processData: false, // Don't process data automatically
                contentType: false, // Set correct content type for FormData
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        alert(response.msg);
                        window.location.href = 'home?id=' + response.id;
                    } else {
                        alert(response.msg || "Error: Unable to process your request.");
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error Details:", xhr.responseText);
                    alert("Something went wrong: " + (xhr.responseText || "Internal Server Error."));
                }
            });

            return false; // Prevent default form submission
        }

    </script>



</body>

</html>
