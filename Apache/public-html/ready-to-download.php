<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your File is Ready to Download</title>
</head>
<body>
    <div style="text-align: center; margin-top: 50px;">
        <h2>Your file is ready to download!</h2>
        <p>Click the button below to download your file:</p>
        
        <div class="ornament" id="ornament-3">  
            <div class="button" id="button-words-3">
                <?php
                // Assuming $convertedFiles is an array you want to pass
                $convertedFiles = $_GET['converted_file'];
                $encodedFiles = json_encode($convertedFiles);
        
                echo '
                <p><a href="download.php?output_file=' . urlencode($encodedFiles) . '">Download</a></p>'
                ?>
            </div>
        </div>

    </div>
</body>
</html>
