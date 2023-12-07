import org.apache.pdfbox.pdmodel.PDDocument;
import org.apache.pdfbox.pdmodel.PDPage;
import org.apache.pdfbox.pdmodel.PDPageContentStream;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;

public class TxtToPdfConverter {
    public static void main(String[] args) {
        String inputFilePath = args[0];
        String outputFilePath = args[1];

        try (PDDocument document = new PDDocument();
             BufferedReader br = new BufferedReader(new FileReader(inputFilePath))) {

            PDPage page = new PDPage();
            document.addPage(page);

            PDPageContentStream contentStream = new PDPageContentStream(document, page);

            float margin = 50;
            float yStart = page.getMediaBox().getHeight() - margin;
            float yPosition = yStart;
            float fontSize = 12;

            contentStream.beginText();
            contentStream.newLineAtOffset(margin, yPosition);
            contentStream.showText("Converted PDF from Text File");
            contentStream.newLineAtOffset(0, -fontSize);
            contentStream.endText();

            String line;
            while ((line = br.readLine()) != null) {
                contentStream.beginText();
                contentStream.newLineAtOffset(margin, yPosition);
                contentStream.showText(line);
                contentStream.endText();
                yPosition -= fontSize;
            }

            contentStream.close();
            document.save(outputFilePath);
            System.out.println("Text file converted to PDF successfully.");
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}
