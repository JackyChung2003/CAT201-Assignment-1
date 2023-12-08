<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pdfFile = $_FILES["pdf"]["tmp_name"];
    $outputFile = "/var/www/html/pdfconverter/output.txt";

    // Call Java application
    $command = "java -jar /path/to/your/java/application.jar $pdfFile $outputFile";
    exec($command);

    // Provide download link for the generated text file
    echo '<a href="/pdfconverter/output.txt" download>Download Text File</a>';
}
?>

<html>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="pdf">Choose a PDF file:</label>
        <input type="file" name="pdf" id="pdf" accept=".pdf">
        <input type="submit" value="Convert">
    </form>
</body>
</html>
