<!DOCTYPE html>
<html lang="en">
<head>
    <?php include ('header.php'); ?>
    <style>
        /* General Centering */
        .content {
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            max-width: 1000px;
        }
        
        /* Center Features Section */
        .features-section {
            padding: 90px 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        
        .feature-box {
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            text-align: center;
            max-width: 700px;
            margin: auto;
        }

        .feature-box:hover {
            background:rgb(63, 238, 177);
            transform: translateY(-5px);
        }

        /* Icons and Text Alignment */
        .feature-icon {
            transition: all 0.3s ease-in-out;
            display: inline-block;
        }

        .feature-icon:hover {
            transform: scale(1.1);
        }

        .list-unstyled {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        /* Image Centering */
        .img-fluid {
            display: block;
            margin: auto;
            max-width: 50%;
        }
    </style>
</head>
<body class="bg-light" id="top">
    <?php include ('nav.php'); ?>

    <!-- Features Section -->
    <section class="features-section text-dark bg-white" id="services">
        <div class="container">
            
            <div class="text-center mb-4">
            </div>
            <div class="feature-box">
                <h3 class="title">For Our Farmers</h3>
                <p>Get smart recommendations for crops and fertilizers, along with accurate predictions for crop yield and crop possibilty. All powered by advanced machine learning trained models and real-time data analysis.</p>
                <img class="img-fluid mt-4" src="https://clipart-library.com/data_images/214919.gif" alt="Agriculture">
            </div>
            
        </div>
    </section>

