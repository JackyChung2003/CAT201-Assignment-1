<!-- // Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle file upload
    $uploadDir = "uploads/";
    $uploadedFile = $uploadDir . basename($_FILES["pdfFile"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($uploadedFile, PATHINFO_EXTENSION));
    // Check if the file is a PDF
    if ($fileType != "pdf") {
        echo "<p style='color: red;'>Only PDF files are allowed.</p>";
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($uploadedFile)) {
        echo "<p style='color: red;'>File already exists.</p>";
        $uploadOk = 0;
    }
    // Upload the file
    if ($uploadOk) {
        if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $uploadedFile)) {
            echo "<p style='color: green;'>File uploaded successfully.</p>";
         
            // TODO: Call Java application to convert PDF to text
            // Use exec() function to execute the Java application
        } else {
            echo "<p style='color: red;'>Error uploading file.</p>";
        }
    }
} -->

<?php
// Example: Log errors to a file
// error_log('An error occurred: ' . $error_message, 3, 'error_log.txt');

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Specify the directory where uploaded files will be stored
    $uploadDirectory = 'Upload_Files/';

    // Specify the directory where the converted file will be stored
    $outputDirectory = 'Output_Files/';
    
    // Check if files were uploaded
    if (!empty($_FILES['pdfFiles']['name'][0])) {

        // Loop through each uploaded PDF and TXT file
        foreach ($_FILES['pdfFiles']['tmp_name'] as $key => $tmp_name) {
            
            // Validate file type
            // get uploaded file extension(get pdf or txt)
            $upload_file_extension = pathinfo($_FILES['pdfFiles']['name'][$key], PATHINFO_EXTENSION);
            
            //Allowed file extension
            $allowed_file_extension = ['pdf', 'csv'];
            // if (strtolower($fileType) !== 'pdf') {
            //     echo 'Error: Only PDF files are allowed.';
            //     return;
            // }
            
            // Output if the file type is not allowed
            if (!in_array(strtolower($upload_file_extension), $allowed_file_extension)) {
                echo 'Error: Only PDF and TXT files are allowed.';
                return; // Stop execution if an error occurs
            }

            // get uploaded file name with extension(.pdf or .txt)
            $upload_file_name = $_FILES['pdfFiles']['name'][$key];
            // $upload_file_name = $_FILES['uploadFile']['name'];


            // if anything happen then try this
            // $upload_file_name = $_FILES['pdfFiles']['name'][$key];

            // rename uploaded file that has spaces between the name
            // $upload_file_name_without_space  = $uploadDirectory . str_replace(' ', '_', basename($_FILES['pdfFiles']['name'][$key]));
            $upload_file_name_without_space = $uploadDirectory . str_replace(' ', '_', basename($upload_file_name));

            // check if renaming is needed
            if ($upload_file_name_without_space != $upload_file_name) {
                rename($upload_file_name_without_space, $upload_file_name);
            }

            // get the file name without extension(no .pdf or .txt)
            // $upload_file_name_without_extension = substr($upload_file_name_without_space, 0, -3);
            $upload_file_name_without_extension = pathinfo($upload_file_name, PATHINFO_FILENAME);

            // get the file temporary name
            $upload_file_tmp_name = $_FILES['pdfFiles']['tmp_name'];
            // $upload_file_tmp_name = $_FILES['pdfFiles']['tmp_name'][$key];
            // echo 'Starting conversion...';

            // check if the uploaded file is a PDF file or a TXT file
            if ($upload_file_extension == "pdf") {
                // move uploaded file to upload directory
                if (move_uploaded_file($upload_file_tmp_name, $uploadDirectory . $upload_file_name)) {

                    // set the location of the uploaded file and the converted file
                    $converted_pdf_file = $upload_file_name_without_extension . ".pdf";
                    $convert_path = $uploadDirectory . $upload_file_name;
                    $output_path = $outputDirectory . $upload_file_name_without_extension;
                    echo 'Entering pdf loop...';
                
                    // convert file to CSV file using a JAR file
                    exec("java -jar pdftotxt.jar $convert_path $output_path");
                    echo 'Finish calling jar file...';
                
                    // redirect to success convert file page if conversion is successful
                    header("Location: success_convert_file.php?converted_file={$converted_pdf_file}");
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
                    $converted_txt_file = $upload_file_name_without_extension . ".pdf";
                    $convert_path = $uploadDirectory . $upload_file_name;
                    $output_path = $outputDirectory . $upload_file_name_without_extension;
                
                    // convert file to CSV file using a JAR file
                    exec("java -jar txttopdf.jar $convert_path $output_path");
                
                    // redirect to success convert file page if conversion is successful
                    header("Location: success_convert_file.php?converted_file={$converted_txt_file}");
                } 
                // error if file is not moved to upload directory
                else {
                    // if an error occurred during uploading
                    // header('Location: error.php'); // redirect to error page if an error occurs
                    echo 'Redirect to error page (error.php)';
                }
            }

            // if the uploaded file is not a PDF file or a TXT file
            else {
                // header('Location: error.php'); // redirect to error page if an error occurs
                echo 'Invalid file type. Only PDF and TXT files are allowed.';
                echo 'Redirect to error page (error.php)';
            }
            
            // Call your Java application for each file
            // $javaCommand = "java -jar /path/to/your/java/application.jar $inputFile $outputFile";
            // exec($javaCommand);
            
            // You can handle the converted text file or provide download links
            // based on your application's logic
        }
        
        echo 'Conversion completed!';
    } else {
        echo 'Please select one or more PDF files for conversion.';
    }
}
?>
