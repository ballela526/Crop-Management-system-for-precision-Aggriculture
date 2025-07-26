<!DOCTYPE html>
<html>

<?php include('header.php'); ?>

<?php include('nav.php'); ?>

<section class="section section-shaped section-lg">
    <div class="shape shape-style-1 shape-primary">
        <span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                
            </div>
        </div>

        <div class="row row-content">
            <div class="col-md-6 mx-auto">
                <div class="card text-white bg-gradient-success mb-3">
                    <div class="card-header">
                        <span class="text-info display-4">Crop Recommendation</span>
                        
                    </div>

                    <div class="card-body text-dark">
                        <form id="recommendForm" role="form" method="post">
                            <div class="form-group">
                                <label class="text-default font-weight-bold">Nitrogen</label>
                                <input type="number" name="n" placeholder="Nitrogen (e.g., 90)" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label  class="text-default font-weight-bold">Phosphorus</label>
                                <input type="number" name="p" placeholder="Phosphorus (e.g., 42)" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-default font-weight-bold">Potassium</label>
                                <input type="number" name="k" placeholder="Potassium (e.g., 43)" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-default font-weight-bold">Temperature</label>
                                <input type="number" name="t" step="0.01" placeholder="Temperature (e.g., 21)" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-default font-weight-bold">Humidity</label>
                                <input type="number" name="h" step="0.01" placeholder="Humidity (e.g., 82)" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-default font-weight-bold">pH</label>
                                <input type="number" name="ph" step="0.01" placeholder="pH (e.g., 6.5)" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="text-default font-weight-bold">Rainfall</label>
                                <input type="number" name="r" step="0.01" placeholder="Rainfall (e.g., 203)" required class="form-control">
                            </div>

                            
                        <div class="form-group text-center">
                                <button type="submit" name="recommendForm" class="btn btn-success btn-submit">Recommend</button>
                            </div>
                        </form>
                    </div>
                </div>
                

                <!-- Display Result -->
                <div class="card text-white bg-gradient-success mb-3">
                    <div class="card-header">
                        <span class="text-success display-4">Result</span>
                    </div>
                    <div class="card-body">
                        <h4>
                            <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Sanitize input
                                $n = escapeshellarg(htmlspecialchars($_POST['n']));
                                $p = escapeshellarg(htmlspecialchars($_POST['p']));
                                $k = escapeshellarg(htmlspecialchars($_POST['k']));
                                $t = escapeshellarg(htmlspecialchars($_POST['t']));
                                $h = escapeshellarg(htmlspecialchars($_POST['h']));
                                $ph = escapeshellarg(htmlspecialchars($_POST['ph']));
                                $r = escapeshellarg(htmlspecialchars($_POST['r']));

                                // Python & script paths
                                $python_path = "C:/Users/hball/AppData/Local/Programs/Python/Python312/python.exe";
                                $script_path = escapeshellarg("C:/Users/hball/Downloads/crop-management-system-main/crop-management-system-main/recommendcrop.py");
                                $model_path = escapeshellarg("C:/Users/hball/Downloads/crop-management-system-main/crop-management-system-main/crop_model.pkl");

                                // Construct command
                                $command = "$python_path $script_path $n $p $k $t $h $ph $r $model_path";

                                // Execute command and capture output
                                $output = shell_exec($command . " 2>&1");

                                // Display result
                                if ($output) {
                                    echo "<pre>Recommended Crop: $output</pre>";
                                } else {
                                    echo "<pre class='text-danger'>Error: No output from the recommendation script.</pre>";
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
<?php include ('footer.php'); ?>
</body>
</html>
