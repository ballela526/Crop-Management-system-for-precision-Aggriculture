<!DOCTYPE html>
<html>
<?php include ('header.php'); ?>

<body class="bg-white" id="top">

<?php include ('nav.php'); ?>

<section class="section section-shaped section-lg">
    <div class="shape shape-style-1 shape-primary">
        <span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span>
        <span></span><span></span>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                
            </div>
        </div>

        <div class="row row-content">
            <div class="col-md-8 mx-auto">
                <div class="card text-white bg-gradient-success mb-3">
                    <div class="card-header">
                        <span class="text-success display-4">Crop Possibility Prediction</span>
                    </div>

                    <div class="card-body text-dark">
                        <form role="form" action="#" method="post">     
                            <div class="form-group">
                                <label class="text-default font-weight-bold">State</label>
                                <input type="text" name="stt" class="form-control" placeholder="Enter State" required>
                            </div>

                            <div class="form-group">
                                <label class="text-default font-weight-bold">District</label>
                                <input type="text" name="district" class="form-control" placeholder="Enter District" required>
                            </div>

                            <div class="form-group">
                                <label class="text-default font-weight-bold">Season</label>
                                <input type="text" name="Season" class="form-control" placeholder="Enter Season" required>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" name="Crop_Predict" class="btn btn-success btn-submit">Predict</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card text-white bg-gradient-success mb-3">
                    <div class="card-header">
                        <span class="text-success display-4">Result</span>
                    </div>

                    <div class="card-body text-dark">
                        <h4>
                        <?php 
                        if(isset($_POST['Crop_Predict'])){
                            $state = trim($_POST['stt']);
                            $district = trim($_POST['district']);
                            $season = trim($_POST['Season']);

                            echo "<strong>Crops grown in " . $district . " during the " . $season . " season are:</strong><br>";

                            $JsonState = json_encode($state);
                            $JsonDistrict = json_encode($district);
                            $JsonSeason = json_encode($season);

                            // Execute Python script
                            $command = escapeshellcmd("python ML/crop_prediction/ZDecision_Tree_Model_Call.py $JsonState $JsonDistrict $JsonSeason");
                            ob_start();
                            passthru($command);
                            $output = ob_get_clean();

                            // Display output in vertical format
                            $crops = explode(" ,", $output);
                            echo "<ul>";
                            foreach ($crops as $crop) {
                                echo ", " . trim($crop) ;
                            }
                            
                        }
                        ?>
                        </h4>
                    </div>
                </div>
            </div>
        </div>  
    </div>
</section>

<?php require("footer.php");?>

</body>
</html>
