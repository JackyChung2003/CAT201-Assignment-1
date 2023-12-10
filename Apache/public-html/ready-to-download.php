<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your File is Ready to Download</title>
    <link rel="stylesheet" href="ready-to-download.css">
</head>

<body>
     <header>
        <a href="index.html" class="logo-link">
            <div class="logo-container">
                <img src="Picture/Icon.png" alt="Convert4U Icon">
                <h1>Convert4U</h1>
            </div>
        </a>
        <div class="navigation-container">
            <a href="index.html" onclick="setActiveLink(this)">All-in-One Mode</a>
            <a href="pdfToText.html" onclick="setActiveLink(this)">PDF to Text</a>
            <a href="textToPdf.html" onclick="setActiveLink(this)">Text to PDF</a>
            <a href="about.html" onclick="setActiveLink(this)">About</a>
        </div>
    </header>
    <main>
        <div style="text-align: center; margin-top: 50px;">
            <h1>Your File is <span class="glow">Ready</span></h1>
            <h2>to Download!</h2>
            <p>Click the button below to download your file. Please note that the file will be downloaded as a zip file.</p>




                <div class="button" id="button-Download">
                    <?php
                    // Assuming $convertedFiles is an array you want to pass
                    $convertedFiles = $_GET['converted_file'];
                    $encodedFiles = json_encode($convertedFiles);

                    echo '
                    <p><a href="download.php?output_file=' . urlencode($encodedFiles) . '">Download</a></p>'
                    ?>
                </div>

        </div>
    </main>

    <footer>
        <p>© 2023 CAT201 Group 22. All rights reserved.</p>
    </footer>
</body>
</html>
