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
// Specify the directory where uploaded files will be stored
$uploadDirectory = 'Upload_Files/';
// Specify the directory where the converted file will be stored
$outputDirectory = 'Output_Files/';
// Example: Log errors to a file
// error_log('An error occurred: ' . $error_message, 3, 'error_log.txt');

// Check if the form is submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    
    // Check if files were uploaded
    if (!empty($_FILES['files']['name'][0])) {

        // var_dump($_FILES);

        // Initialize an array to store output file names + extension (ex. sample.pdf)
        $convertedFiles = [];

        $totalFiles = count($_FILES['files']['name']);

        // echo "Total files: $totalFiles<br>";

        // Loop through each uploaded PDF and TXT file
        foreach ($_FILES['files']['tmp_name'] as $key => $tmp_name) {
        // for ($key = 0; $key < $totalFiles; $key++) {
            // echo "Key: $key<br>";
            // Validate file type
            // get uploaded file extension(get pdf or txt)
            $upload_file_extension = pathinfo($_FILES['files']['name'][$key], PATHINFO_EXTENSION);
            
            //Allowed file extension
            $allowed_file_extension = ['pdf', 'txt'];
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
            $upload_file_name = $_FILES['files']['name'][$key];
            // $upload_file_name = $_FILES['uploadFile']['name'];


            // if anything happen then try this
            // $upload_file_name = $_FILES['pdfFiles']['name'][$key];

            // rename uploaded file that has spaces between the name
            // $upload_file_name_without_space  = $uploadDirectory . str_replace(' ', '_', basename($_FILES['pdfFiles']['name'][$key]));
            // $upload_file_name_without_space = $uploadDirectory . str_replace(' ', '_', basename($upload_file_name));
            $upload_file_name_without_space = str_replace(' ', '_', basename($upload_file_name));
            // echo "Original Filename: $upload_file_name<br>";
            // echo "Renamed Filename: $upload_file_name_without_space<br>";
            // $hasSpaces = ($upload_file_name_without_space != $upload_file_name);
            // echo "Has Spaces: " . ($hasSpaces ? "Yes" : "No") . "<br>";
            // echo 'Renaming file...';
            // check if renaming is needed
            // if ($upload_file_name_without_space != $upload_file_name) {
            //     rename($upload_file_name_without_space, $upload_file_name);
            // }
            // echo "Origin/al Filename: $upload_file_name<br>";
            // echo "Renamed Filename: $upload_file_name_without_space<br>";
            if (trim($upload_file_name_without_space) != trim($upload_file_name)) {
                // echo "Before Original Filename: $upload_file_name<br>";
                // echo "Before Renamed Filename: $upload_file_name_without_space<br>";
                // rename($upload_file_name_without_space, $upload_file_name);
                $upload_file_name = $upload_file_name_without_space;
                // echo "After Original Filename: $upload_file_name<br>";
                // echo "After Renamed Filename: $upload_file_name_without_space<br>";
            }
            
            

            // get the file name without extension(no .pdf or .txt)
            // $upload_file_name_without_extension = substr($upload_file_name_without_space, 0, -3);
            $upload_file_name_without_extension = pathinfo($upload_file_name, PATHINFO_FILENAME);
            echo $upload_file_name_without_extension;
            // get the file temporary name
            // $upload_file_tmp_name = $_FILES['files']['tmp_name'];
            $upload_file_tmp_name = $_FILES['files']['tmp_name'][$key];
            // echo 'Starting conversion...';



            // set the location of the uploaded file and the converted file
            $converted_pdf_file = $upload_file_name_without_extension . ".txt";
            $converted_txt_file = $upload_file_name_without_extension . ".pdf";

            // check if the uploaded file is a PDF file or a TXT file
            if ($upload_file_extension == "pdf") {
                // echo 'SUSSSSSSSSSSSSSSSSS<br>';
                // echo "upload_file_tmp_name: $upload_file_tmp_name<br>";
                // echo "upload_file_path: $uploadDirectory . $upload_file_name<br>";
                // echo "upload_file_name: $upload_file_name<br>";


                // if ($_FILES['files']['error'][$key] !== UPLOAD_ERR_OK) {
                //     echo 'Error uploading file. Code: ' . $_FILES['files']['error'][$key];
                //     return;
                // }
                // if ($upload_file_tmp_name == UPLOAD_ERR_OK) {
                //     echo 'Error uploading file. Code: ' . $_FILES['files']['name'][$key];
                //     return;
                // }

                // move uploaded file to upload directory
                if (move_uploaded_file($upload_file_tmp_name, $uploadDirectory. $upload_file_name)) {

                    // set the location of the uploaded file and the converted file
                    // $converted_pdf_file = $upload_file_name_without_extension . ".txt";

                    // $scriptDir = dirname(__FILE__);


                    // $convert_path = $scriptDir . $uploadDirectory . $upload_file_name;
                    // $output_path = $scriptDir . $outputDirectory . $upload_file_name_without_extension;

                    
                    $convert_path = $uploadDirectory . $upload_file_name;
                    $output_path = $outputDirectory . $upload_file_name_without_extension;


                    // echo 'Entering pdf loop...';
                    
                    // if (is_writable($outputDirectory)) {
                    //     echo "Directory is writable.";
                    // } else {
                    //     echo "Directory is not writable.";
                    // }

                    // convert file to CSV file using a JAR file
                    // exec("java -jar pdf2txt.jar $convert_path $output_path");

                    // $output = [];
                    // $returnCode = 0;
                    // exec("java -jar /var/www/CAT_201_APACHE/pdf2txt.jar Upload_Files/sample.pdf Output_Files/testing", $output, $returnCode);

                    // if ($returnCode !== 0) {
                    //     echo "Error executing Java command: " . implode("\n", $output);
                    // }
                    // else {
                    //     echo "Java command executed successfully: " . implode("\n", $output);
                    // }

                    $command = "java -jar /var/www/CAT201-Assignment-1/pdf2txt.jar $convert_path $output_path";
                    // echo "Executing command: $command";
                    $output = [];
                    $returnCode = 0;
                    exec($command, $output, $returnCode);


                    $convertedFiles[] = $converted_pdf_file;

                    // if ($returnCode !== 0) {
                    //     echo "Error executing Java command: " . implode("\n", $output);
                    // } else {
                    //     echo "Java command executed successfully: " . implode("\n", $output);
                    // }

                    // java -jar pdf2txt.jar "Upload_Files/sample.pdf" "Output_Files/testing"
                    
                    // $command = "java -cp project/lib/pdfbox-app-3.0.1.jar:project/src pdfConvertTotxt $convertPath $outputPath";

                    $output = shell_exec($command);
                    // echo 'Entering pdf loop...';
                    // echo $converted_pdf_file;

                    // echo 'Finish calling jar file...';
                
                    // redirect to success convert file page if conversion is successful
                    // header("Location: ready-to-download.php?converted_file={$converted_pdf_file}");
                } 
                // error if file is not moved to upload directory
                else {
                    // if an error occurred during uploading
                    // echo 'Error: ' . error_get_last()['message'];
                    // echo 'The file was not uploaded.';
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
                    // exec("java -jar txttopdf.jar $convert_path $output_path");
                    $command = "java -jar /var/www/CAT201-Assignment-1/txt2pdf.jar $convert_path $output_path";
                    $output = [];
                    $returnCode = 0;
                    exec($command, $output, $returnCode);

                    $convertedFiles[] = $converted_txt_file;

                    $output = shell_exec($command);
                
                    // redirect to success convert file page if conversion is successful
                    // header("Location: success_convert_file.php?converted_file={$converted_txt_file}");
                } 
                // error if file is not moved to upload directory
                else {
                    // if an error occurred during uploading
                    // header('Location: error.php'); // redirect to error page if an error occurs
                    echo 'Redirect to error page (error.php)';
                    header('Location: error.php');
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

        // Now $convertedFiles should contain all the converted file names
        // var_dump($convertedFiles);

        // echo 'List of uploaded files: ' . implode(', ', $uploadedFiles);
        // header("Location: ready-to-download.php?converted_file={$converted_pdf_file}");

        // Serialize the array into a string
        $serializedFiles = serialize($convertedFiles);

        // Encode the serialized string to make it URL-safe
        $encodedFiles = urlencode($serializedFiles);
        
        
        // pass the encoded string to the next page, then will be decoded at that page
        header("Location: ready-to-download.php?converted_file={$encodedFiles}");
        // header("Location: download.php?output_file={$encodedFiles}");
        
        // echo 'Conversion completed!';
    } else {
        echo 'Please select one or more PDF files for conversion.';
    }
}
?>


