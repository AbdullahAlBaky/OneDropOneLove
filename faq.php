
<?php include 'navbar.php'; ?>
<?php include 'sidebar.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>FAQ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-4">

<h2 class="text-center mb-4">❓ Frequently Asked Questions</h2>

<div class="accordion" id="faq">

    
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#q1">
                Who can donate blood?
            </button>
        </h2>
        <div id="q1" class="accordion-collapse collapse show">
            <div class="accordion-body">
                Any healthy person aged 18-60 can donate blood.
            </div>
        </div>
    </div>

    
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#q2">
                How often can I donate?
            </button>
        </h2>
        <div id="q2" class="accordion-collapse collapse">
            <div class="accordion-body">
                You can donate blood every 3 months.
            </div>
        </div>
    </div>

    
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#q3">
                Is blood donation safe?
            </button>
        </h2>
        <div id="q3" class="accordion-collapse collapse">
            <div class="accordion-body">
                Yes, it is completely safe and hygienic.
            </div>
        </div>
    </div>

    
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#q4">
                Which blood group is universal donor?
            </button>
        </h2>
        <div id="q4" class="accordion-collapse collapse">
            <div class="accordion-body">
                O- is known as the universal donor.
            </div>
        </div>
    </div>

</div>


<div class="text-center mt-4">
    <p>Still have questions? Contact us 📞</p>
    <a href="contact.php" class="btn btn-danger">Contact Us</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<?php include 'footer.php'; ?>

</body>
</html>