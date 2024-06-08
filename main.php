<?php

// Function to read data from CSV file
function readCSV($filePath) {
    $file = fopen($filePath, 'r');
    $data = [];
    fgetcsv($file); // Skip header row
    while (($row = fgetcsv($file)) !== FALSE) {
        $data[] = $row;
    }
    fclose($file);
    return $data;
}

// Function to save data to CSV file
function saveCSV($filename, $data) {
    $file = fopen($filename, 'w');
    foreach ($data as $row) {
        fputcsv($file, $row);
    }
    fclose($file);
}

// Function to calculate linear regression coefficients
function linearRegression($x, $y) {
    $n = count($x);
    $x_mean = array_sum($x) / $n;
    $y_mean = array_sum($y) / $n;
    $numerator = 0;
    $denominator = 0;
    for ($i = 0; $i < $n; $i++) {
        $numerator += ($x[$i] - $x_mean) * ($y[$i] - $y_mean);
        $denominator += pow(($x[$i] - $x_mean), 2);
    }
    $slope = $numerator / $denominator;
    $intercept = $y_mean - ($slope * $x_mean);
    return [$slope, $intercept];
}

// Function to calculate power regression coefficients
function powerRegression($x, $y) {
    $log_x = array_map('log', $x);
    $log_y = array_map('log', $y);
    list($slope, $intercept) = linearRegression($log_x, $log_y);
    return [$slope, exp($intercept)];
}

// Function to predict values using linear regression
function predictLinear($x, $slope, $intercept) {
    return $slope * $x + $intercept;
}

// Function to predict values using power regression
function predictPower($x, $slope, $intercept) {
    return $intercept * pow($x, $slope);
}

// Function to calculate RMS error
function rmsError($predicted, $actual) {
    $n = count($predicted);
    $sum = 0;
    for ($i = 0; $i < $n; $i++) {
        $sum += pow($predicted[$i] - $actual[$i], 2);
    }
    return sqrt($sum / $n);
}

// Read the data
$data = readCSV('student_performance.csv');
$TB = array_column($data, 0); // Hours Studied
$NT = array_column($data, 1); // Performance Index

// Calculate linear regression coefficients
list($linearSlope, $linearIntercept) = linearRegression($TB, $NT);

// Calculate power regression coefficients
list($powerSlope, $powerIntercept) = powerRegression($TB, $NT);

// Predict values
$linearPredictions = array_map(function($x) use ($linearSlope, $linearIntercept) {
    return predictLinear($x, $linearSlope, $linearIntercept);
}, $TB);

$powerPredictions = array_map(function($x) use ($powerSlope, $powerIntercept) {
    return predictPower($x, $powerSlope, $powerIntercept);
}, $TB);

// Calculate RMS errors
$linearRmsError = rmsError($linearPredictions, $NT);
$powerRmsError = rmsError($powerPredictions, $NT);

echo "Linear Regression RMS Error: $linearRmsError\n </br>";
echo "Power Regression RMS Error: $powerRmsError\n";

// Prepare data for CSV
$linearData = array_map(function($x, $y, $pred) {
    return [$x, $y, $pred];
}, $TB, $NT, $linearPredictions);

$powerData = array_map(function($x, $y, $pred) {
    return [$x, $y, $pred];
}, $TB, $NT, $powerPredictions);

// Save linear regression data
saveCSV('linear_regression.csv', $linearData);

// Save power regression data
saveCSV('power_regression.csv', $powerData);

?>
