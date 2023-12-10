<?php
// // Check if the filename is provided in the query parameter
if (isset($_GET['output_file'])) {

// Check if the filename is provided in the POST parameter
// if (isset($_POST['output_file'])) {
    // Get the filename from the query parameter
    
    $encodedFiles = $_GET['output_file'];
    // $encodedFiles = $_POST['output_file'];
    // echo "encodedFiles: " . $encodedFiles . "<br>";

    // echo "encodedFiles: " . $encodedFiles . "<br>";
    $decodedFiles = json_decode(htmlspecialchars_decode($encodedFiles), true);
    // echo "decodedFiles: " . $decodedFiles . "<br>";

    // Decode the URL-encoded string
    // $decodedFiles = urldecode($encodedFiles);

    // echo "decodedFiles: " . $decodedFiles . "<br>";

    // Unserialize the string back into an array
    $convertedFiles = unserialize($decodedFiles);
    // echo "convertedFiles: " . $convertedFiles . "<br>";
    // print_r($convertedFiles);

    // echo "convertedFiles: ";
    // print_r($convertedFiles);
    // echo "<br>";

    // Set the path to the directory where the files are stored
    $outputDirectory = 'Output_Files/';

    // if (class_exists('ZipArchive')) {
    //     echo 'ZipArchive class is available.';
    // } else {
    //     echo 'ZipArchive class is not available.';
    // }
    // Create a zip archive
    // $zip = new ZipArchive();
    $zip = new ZipArchive;
    $zipFilename = $outputDirectory . 'converted_files.zip';

    // // // Set the full path to the file
    // // $filepath = $outputDirectory . $filename;
    // foreach ($convertedFiles as $filename) {
    //     // Set the full path to the file
    //     $filepath = $outputDirectory . $filename;

    //     // echo "filepath: " . $filepath . "<br>";

    //     // Check if the file exists
    //     if (file_exists($filepath)) {
    //         // Set the appropriate headers for file download

    //         header('Content-Description: File Transfer');
    //         header('Content-Type: application/octet-stream');
    //         header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
    //         header('Expires: 0');
    //         // header('Cache-Control: must-revalidate');
    //         header('Cache-Control: public');
    //         header('Pragma: public');
    //         header('Content-Length: ' . filesize($filepath));

    //                     // echo "file exists<br>";
    //         // echo "filename: " . $filename . "<br>";
    //         readfile($filepath);
    //     } else {
    //         // If the file does not exist, display an error message
    //         echo 'File not found: ' . $filename . '<br>';
    //     }
    // }

    if ($zip->open($zipFilename, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
        foreach ($convertedFiles as $filename) {
            // Set the full path to the file
            $filepath = $outputDirectory . $filename;

            // Check if the file exists
            if (file_exists($filepath)) {
                // Add the file to the zip archive
                $zip->addFile($filepath, $filename);
                // echo "filepath: " . $filepath . "<br>";
                // echo "filename: " . $filename . "<br>";
            } else {
                // If the file does not exist, display an error message
                echo 'File not found: ' . $filename . '<br>';
            }
        }

        // Close the zip archive
        $zip->close();

        // Set appropriate headers for zip file download
        header('Content-Type: application/zip');
        header('Content-Disposition: attachment; filename="' . basename($zipFilename) . '"');
        header('Content-Length: ' . filesize($zipFilename));

        // Read and output the zip file content
        readfile($zipFilename);

        // Remove the zip file after download
        unlink($zipFilename);

        // Exit to prevent any further output
        exit;
    } else {
        echo "Error creating zip archive";
    }

    // Loop through each file in the array
    // foreach ($convertedFiles as $filename) {
    //     // Set the full path to the file
    //     $filepath = $outputDirectory . $filename;

    //     // Check if the file exists
    //     if (file_exists($filepath)) {
    //         // Set the appropriate headers for file download
    //         header('Content-Description: File Transfer');
    //         header('Content-Type: application/octet-stream');
    //         header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
    //         header('Expires: 0');
    //         header('Cache-Control: must-revalidate');
    //         header('Pragma: public');
    //         header('Content-Length: ' . filesize($filepath));
    //         readfile($filepath);
    //     } else {
    //         // If the file does not exist, display an error message
    //         echo 'File not found: ' . $filename . '<br>';
    //     }
    // }

    // exit;
} else {
    // If no filename is provided, display an error message
    echo 'Filename not provided.';
}
?>