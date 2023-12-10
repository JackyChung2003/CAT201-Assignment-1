<?php
// Specify the directory where uploaded files will be stored
$uploadDirectory = 'Upload_Files/';
// Specify the directory where the converted file will be stored
$outputDirectory = 'Output_Files/';

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if files were uploaded
    if (!empty($_FILES['files']['name'][0])) {

        // Initialize an array to store output file names + extension (ex. sample.pdf)
        $convertedFiles = [];

        $totalFiles = count($_FILES['files']['name']);

        // Loop through each uploaded PDF and TXT file
        foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
            // Validate file type
            // get uploaded file extension(get pdf or txt)
            $upload_file_extension = pathinfo($_FILES['files']['name'][$key], PATHINFO_EXTENSION);
            
            //Allowed file extension
            $allowed_file_extension = ['pdf', 'txt'];
            
            // Output if the file type is not allowed
            if (!in_array(strtolower($upload_file_extension), $allowed_file_extension)) {
                echo 'Error: Only PDF and TXT files are allowed.';
                return; // Stop execution if an error occurs
            }

            // get uploaded file name with extension(.pdf or .txt)
            $upload_file_name = $_FILES['files']['name'][$key];

            // rename uploaded file that has spaces between the name
            $upload_file_name_without_space = str_replace(' ', '_', basename($upload_file_name));

            // check if renaming is needed
            if (trim($upload_file_name_without_space) != trim($upload_file_name)) {
                $upload_file_name = $upload_file_name_without_space;
            }
            
            // get the file name without extension(no .pdf or .txt)
            $upload_file_name_without_extension = pathinfo($upload_file_name, PATHINFO_FILENAME);

            // get the file temporary name
            $upload_file_tmp_name = $_FILES['files']['tmp_name'][$key];

            // set the location of the uploaded file and the converted file
            $converted_pdf_file = $upload_file_name_without_extension . ".txt";
            $converted_txt_file = $upload_file_name_without_extension . ".pdf";

            // check if the uploaded file is a PDF file or a TXT file
            if ($upload_file_extension == "pdf") {
                // move uploaded file to upload directory
                if (move_uploaded_file($upload_file_tmp_name, $uploadDirectory. $upload_file_name)) {
                    $convert_path = $uploadDirectory . $upload_file_name;
                    $output_path = rtrim($outputDirectory, '/') . '/' . $upload_file_name_without_extension;
                    $command = "java -jar /var/www/html/pdf2txt.jar $convert_path $output_path";
                    $output = [];
                    $returnCode = 0;
                    exec($command, $output, $returnCode);
                    $convertedFiles[] = $converted_pdf_file;
                    $output = shell_exec($command);

                    // redirect to success convert file page if conversion is successful
                    // header("Location: success_convert_file.php?converted_file={$converted_txt_file}");
                } 
                // error if file is not moved to upload directory
                else {
                    // if an error occurred during uploading
                    header('Location: error.php'); // redirect to error page if an error occurs
                }
            }
            // check if the uploaded file is an TXT file
            else if ($upload_file_extension == "txt") {
                // move uploaded file to upload directory
                if (move_uploaded_file($upload_file_tmp_name, $uploadDirectory . $upload_file_name)) {

                    // set the location of the uploaded file and the converted file
                    // $converted_txt_file = $upload_file_name_without_extension . ".pdf";
                    $convert_path = $uploadDirectory . $upload_file_name;
                    $output_path = $outputDirectory . $upload_file_name_without_extension;
                
                    // convert file to CSV file using a JAR file
                    $command = "java -jar /var/www/html/txt2pdf.jar $convert_path $output_path";
                    $output = [];
                    $returnCode = 0;
                    exec($command, $output, $returnCode);
                    $convertedFiles[] = $converted_txt_file;
                    $output = shell_exec($command);
                } 
                // error if file is not moved to upload directory
                else {
                    echo 'Redirect to error page (error.php)';
                    header('Location: error.php');
                }
            }

            // if the uploaded file is not a PDF file or a TXT file
            else {
                echo 'Invalid file type. Only PDF and TXT files are allowed.';
                echo 'Redirect to error page (error.php)';
            }
         }

        // Now $convertedFiles should contain all the converted file names
        //var_dump($convertedFiles);

        // Serialize the array into a string
        $serializedFiles = serialize($convertedFiles);

        // Encode the serialized string to make it URL-safe
        $encodedFiles = urlencode($serializedFiles);
        
        // pass the encoded string to the next page, then will be decoded at that page
        header("Location: ready-to-download.php?converted_file={$encodedFiles}");
    } else {
        echo 'Please select one or more PDF files for conversion.';
    }
}
?>