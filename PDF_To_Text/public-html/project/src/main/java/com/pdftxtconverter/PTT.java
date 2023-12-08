// package com.pdftxtconverter;

// import java.io.File;
// import java.io.IOException;
// import org.apache.pdfbox.pdmodel.PDDocument;
// import org.apache.pdfbox.Loader;
// import org.apache.pdfbox.text.PDFTextStripper;

// public class PTT {
//     public static void main(String[] args) {
//         if (args.length != 2) {
//              System.out.println("Usage: PDFToTextConverter <input-pdf> <output-txt>");
//              return;
//          }

//         String inputFilePath = args[0];
//         String OutputFilePath = args[1];
//         System.out.println("Hello World");
//    try {
//             // Load PDF document
//              PDDocument document = PDDocument.loadPDF(new File(inputFilePath));
//             //PDDocument document = Loader.loadPDF(new File(inputFilePath));

//             // Create PDFTextStripper0
//             PDFTextStripper pdfTextStripper = new PDFTextStripper();

//             // Get text from the PDF
//             String text = pdfTextStripper.getText(document);

//             // Save text to output file
//             // You can customize this part based on your requirements
//             // For example, you might want to save the text to a database or perform additional processing.
//             // In this example, it simply writes the text to a text file.
//             java.nio.file.Files.write(java.nio.file.Paths.get(OutputFilePath), text.getBytes());

//             // Close the PDF document
//             document.close();

//             System.out.println("PDF to text conversion completed.");

//         } catch (IOException e) {
//             System.out.println("errorrr");
//            // e.printStackTrace();
//         }
//         System.out.println("Hello afddadfs");
//     }
// }

package com.pdftxtconverter;

import java.io.File;
import java.io.IOException;
import java.nio.file.Files;
import java.nio.file.Paths;

import org.apache.pdfbox.pdmodel.PDDocument;
import org.apache.pdfbox.Loader;
import org.apache.pdfbox.text.PDFTextStripper;

public class PTT {
    public static void main(String[] args) {
         if (args.length != 2) {
             System.out.println("Usage: PDFToTextConverter <input-pdf> <output-txt>");
             return;
         }

        String inputFilePath = args[0];
        String OutputFilePath = args[1] + ".txt";

        try {
            // Load PDF document
            // PDDocument document = PDDocument.load(new File(inputFilePath));
//            

//            File document = new File(args[0]);
            //PDDocument document = PDDocument.load(new File(args[0]));
            PDDocument document = Loader.loadPDF(new File(inputFilePath));
//            PDDocument document = PDDocument.load( new File("../sample.pdf"));
            // Create PDFTextStripper0
            PDFTextStripper pdfTextStripper = new PDFTextStripper();

            // Get text from the PDF
            String text = pdfTextStripper.getText(document);

            // Save text to output file
            // You can customize this part based on your requirements
            // For example, you might want to save the text to a database or perform additional processing.
            // In this example, it simply writes the text to a text file.

            // OutputFilePath = OutputFilePath + ".txt";

            Files.write(Paths.get(OutputFilePath), text.getBytes());

            // Close the PDF document
            document.close();

            System.out.println("PDF to text conversion completed.");

        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}