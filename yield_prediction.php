<!DOCTYPE html>
<html>
<?php include ('header.php'); ?>

<body class="bg-white" id="top">
<?php include ('nav.php'); ?>

<section class="section section-shaped section-lg">
    <div class="shape shape-style-1 shape-primary">
        <span></span><span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span><span></span>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
            
            </div>
        </div>

        <div class="row row-content">
            <div class="col-md-8 mx-auto">
                <div class="card text-white bg-gradient-success mb-3">
                    <form role="form" action="#" method="post">
                        <div class="card-header">
                            <span class="text-info display-4">Yield Prediction</span>
                        </div>

                        <div class="card-body text-dark">
                            <div class="form-group">
                                <label class="text-default font-weight-bold">State</label>
                                <input type="text" name="state" placeholder="Enter State" required class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="text-default font-weight-bold">District</label>
                                <input type="text" name="district" placeholder="Enter District" required class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="text-default font-weight-bold">Crop Year</label>
                                <input type="number" name="crop_year" placeholder="Enter Crop Year" required class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="text-default font-weight-bold">Season</label>
                                <input type="text" name="season" placeholder="Enter Season" required class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="text-default font-weight-bold">Crop</label>
                                <input type="text" name="crop" placeholder="Enter Crop" required class="form-control">
                            </div>

                            <div class="form-group">
                                <label class="text-default font-weight-bold">Area (Hectares)</label>
                                <input type="number" step="0.01" name="area" placeholder="Area in Hectares" required class="form-control">
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" name="Yield_Predict" class="btn btn-success btn-submit">Predict</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card text-white bg-gradient-success mb-3">
                    <div class="card-header">
                        <span class="text-success display-4">Result</span>
                    </div>
                    <div class="card-body text-dark">
                        <h4>
                        <?php
                        if (isset($_POST['Yield_Predict'])) {
                            $state = escapeshellarg($_POST['state']);
                            $district = escapeshellarg($_POST['district']);
                            $crop_year = escapeshellarg($_POST['crop_year']);
                            $season = escapeshellarg($_POST['season']);
                            $crop = escapeshellarg($_POST['crop']);
                            $area = escapeshellarg($_POST['area']);

                            // Construct the command
                            $command = "python yield_prediction.py $state $district $crop_year $season $crop $area 2>&1";

                            // Debugging: Print the command (remove in production)
                            //echo "<pre>Executing: $command</pre>";

                            // Execute the command
                            $output = shell_exec($command);

                            // Debugging: Print the raw output (remove in production)
                            //echo "<pre>Raw Output: $output</pre>";

                            // Display the result
                            if (!empty($output)) {
                                echo "Predicted crop yield (in Quintal) is: " . htmlspecialchars($output);
                            } else {
                                echo "<span class='text-danger'>Error in prediction! Please check inputs.</span>";
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

<?php require("footer.php"); ?>
</body>
</html>
