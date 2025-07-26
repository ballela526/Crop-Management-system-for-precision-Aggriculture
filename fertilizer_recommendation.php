<!DOCTYPE html>
<html>

<?php include ('header.php'); ?>

<body class="bg-white" id="top">

<?php include ('nav.php'); ?>


<section class="section section-shaped section-lg">
    <div class="shape shape-style-1 shape-primary">
        <span></span><span></span><span></span><span></span>
        <span></span><span></span><span></span><span></span>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto text-center">
                
            </div>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card bg-gradient-success text-white mb-4">
                    <div class="card-header">
                    <span class="text-info display-4">Fertilizer Recommendation</span>
                    </div>
                    <div class="card-body text-dark">
                    
                        <form method="post">
                        
                            <div class="form-group">
                                <label class="text-default font-weight-bold" for="n">Nitrogen</label>
                                <input type="number" name="n" id="n" class="form-control" placeholder="Eg: 37" required>
                            </div>
                            
                            <div class="form-group">
                                <label class="text-default font-weight-bold" for="p">Phosphorus</label>
                                <input type="number" name="p" id="p" class="form-control" placeholder="Eg: 0" required>
                            </div>

                            <div class="form-group">
                                <label class="text-default font-weight-bold" for="k">Potassium</label>
                                <input type="number" name="k" id="k" class="form-control" placeholder="Eg: 0" required>
                            </div>

                            <div class="form-group">
                                <label class="text-default font-weight-bold"for="t">Temperature</label>
                                <input type="number" name="t" id="t" class="form-control" placeholder="Eg: 26" required>
                            </div>

                            <div class="form-group">
                                <label class="text-default font-weight-bold" for="h">Humidity</label>
                                <input type="number" name="h" id="h" class="form-control" placeholder="Eg: 52" required>
                            </div>

                            <div class="form-group">
                                <label class="text-default font-weight-bold" for="soilMoisture">Soil Moisture</label>
                                <input type="number" name="soilMoisture" id="soilMoisture" class="form-control" placeholder="Eg: 38" required>
                            </div>

                            <div class="form-group">
                                <label class="text-default font-weight-bold" for="soil">Soil Type</label>
                                <select name="soil" id="soil" class="form-control" required>
                                    <option value="">Select Soil Type</option>
                                    <option value="Sandy">Sandy</option>
                                    <option value="Loamy">Loamy</option>
                                    <option value="Black">Black</option>
                                    <option value="Red">Red</option>
                                    <option value="Clayey">Clayey</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="text-default font-weight-bold" for="crop">Crop</label>
                                <select name="crop" id="crop" class="form-control" required>
                                    <option value="">Select Crop</option>
                                    <option value="Maize">Maize</option>
                                    <option value="Sugarcane">Sugarcane</option>
                                    <option value="Cotton">Cotton</option>
                                    <option value="Tobacco">Tobacco</option>
                                    <option value="Paddy">Paddy</option>
                                    <option value="Barley">Barley</option>
                                    <option value="Wheat">Wheat</option>
                                    <option value="Millets">Millets</option>
                                    <option value="Oil seeds">Oil seeds</option>
                                    <option value="Pulses">Pulses</option>
                                    <option value="Ground Nuts">Ground Nuts</option>
                                </select>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" name="Fert_Recommend" class="btn btn-success btn-submit">Recommend</button>
                            </div>
                            
                        </form>
                    </div>
                </div>

                <!-- Result Section -->
                <div class="card bg-gradient-success text-white">
                    <div class="card-header text-center">
                        <h2 class="text-success">Result</h2>
                    </div>
                    <div class="card-body text-dark">
                        <h4>
                            <?php 
                            if (isset($_POST['Fert_Recommend'])) {
                                // Get input values
                                $n = trim($_POST['n']);
                                $p = trim($_POST['p']);
                                $k = trim($_POST['k']);
                                $t = trim($_POST['t']);
                                $h = trim($_POST['h']);
                                $sm = trim($_POST['soilMoisture']);
                                $soil = trim($_POST['soil']);
                                $crop = trim($_POST['crop']);

                                
                                $python_path = "C:/Users/hball/AppData/Local/Programs/Python/Python312/python.exe";
                                $script_path = "C:/Users/hball/Downloads/crop-management-system-main/crop-management-system-main/recommendfertilizer.py";

                                
                                $command = escapeshellcmd("$python_path $script_path " . 
                                    escapeshellarg($n) . " " . 
                                    escapeshellarg($p) . " " . 
                                    escapeshellarg($k) . " " . 
                                    escapeshellarg($t) . " " . 
                                    escapeshellarg($h) . " " . 
                                    escapeshellarg($sm) . " " . 
                                    escapeshellarg($soil) . " " . 
                                    escapeshellarg($crop));

                                // Execute the command and get output
                                $output = shell_exec($command . " 2>&1");

                                // Display result
                                echo "<pre>Recommended Fertilizer: $output</pre>";
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
