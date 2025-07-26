<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crop Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css">
    <style>
        /* Sidebar styling */
        #sidebar {
            width: 250px;
            height: 200vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color:rgb(96, 199, 127);
            padding-top: 20px;
            z-index: 1550; /* Ensure it's above content */
        }

        #sidebar .nav-link {
            color: white;
            font-size: 16px;
        }

        #sidebar .nav-link:hover {
            background-color:rgb(103, 220, 146);
        }

        #content {
            margin-left: 250px; /* Push main content */
            padding: 20px;
            transition: margin-left 0.3s ease-in-out;
        }

        .topnav a {
            border-bottom: 1px solid transparent;
        }

        .topnav a:hover, .topnav a.active {
            border-bottom: 3px solid red;
        }

        /* Responsive sidebar */
        @media screen and (max-width: 1500px) {
            #sidebar {
                width: 200px;
            }

            #content {
                margin-left: 200px;
            }
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <nav id="sidebar" class="bg-dark">
        <ul class="nav flex-column">
            <li class="nav-item text-center">
                <a href="index.php" class="navbar-brand text-white">
                    <img src="assets/img/nav.png" width="120px">
                </a>
            </li>
            <li class="nav-item">
                <a href="crop_recommendation.php" class="nav-link">
                    <i class="fas fa-seedling"></i> Crop Recommendation
                </a>
            </li>
            <li class="nav-item">
                <a href="fertilizer_recommendation.php" class="nav-link">
                    <i class="fas fa-gavel"></i> Fertilizer Recommendation
                </a>
            </li>
            </li>
            <li class="nav-item">
                <a href="yield_prediction.php" class="nav-link">
                    <i class="fas fa-chart-line"></i> Yield Prediction
                </a>
            </li>
            <li class="nav-item">
                <a href="crop_prediction.php" class="nav-link">
                    <i class="fas fa-magic"></i> Crop Prediction
                </a>
        </ul>
    </nav>

    <!-- Main Content -->
    <div id="content">
        <h2>Crop Management System</h2>
        <p>Welcome to the crop management system, a true farmer's friend.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script>
        $("#nav li a").each(function() {   
            if (this.href == window.location.href) {
                $(this).addClass("active");
            }
        });
    </script>

</body>
</html>
