import java.io.File;
import java.io.IOException;

import org.apache.pdfbox.pdmodel.PDDocument;
import org.apache.pdfbox.Loader;
import org.apache.pdfbox.text.PDFTextStripper;

public class pdftotxt {
    public static void main(String[] args) {
        // if (args.length != 2) {
        //     System.out.println("Usage: PDFToTextConverter <input-pdf> <output-txt>");
        //     return;
        // }

        String inputFilePath = args[0];
        String OutputFilePath = args[1];

        try {
            // Load PDF document
            // PDDocument document = PDDocument.load(new File(inputFilePath));
            PDDocument document = Loader.loadPDF(new File(inputFilePath));

            // Create PDFTextStripper0
            PDFTextStripper pdfTextStripper = new PDFTextStripper();

            // Get text from the PDF
            String text = pdfTextStripper.getText(document);

            // Save text to output file
            // You can customize this part based on your requirements
            // For example, you might want to save the text to a database or perform additional processing.
            // In this example, it simply writes the text to a text file.
            java.nio.file.Files.write(java.nio.file.Paths.get(OutputFilePath), text.getBytes());

            // Close the PDF document
            document.close();

            System.out.println("PDF to text conversion completed.");

        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}
