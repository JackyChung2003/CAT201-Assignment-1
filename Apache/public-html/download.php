<?php
// // Check if the filename is provided in the query parameter
if (isset($_GET['output_file'])) {
    
    $encodedFiles = $_GET['output_file'];
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

    // Set the path to the directory where the files are stored
    $outputDirectory = 'Output_Files/';

    // Create a zip archive
    // $zip = new ZipArchive();
    $zip = new ZipArchive;
    $zipFilename = $outputDirectory . 'converted_files.zip';

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
} else {
    // If no filename is provided, display an error message
    echo 'Filename not provided.';
}
?>

