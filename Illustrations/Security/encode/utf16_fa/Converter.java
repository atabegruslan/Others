import java.nio.file.*;
import java.io.*;

public class Converter {

    public static void main(String[] args) {

        Path source = FileSystems.getDefault().getPath("./font_awesome-4_7_0/css","font-awesome.css");
        Path result = FileSystems.getDefault().getPath("./font_awesome-4_7_0/css","font-awesome-utf16.css");

        try(Reader r = new InputStreamReader(new FileInputStream(source.toFile()), "UTF-8");
            Writer w = new OutputStreamWriter(new FileOutputStream(result.toFile()), "UTF-16")) {

            char buffer[] = new char[2048];
            int length;

            while ((length = r.read(buffer, 0, buffer.length)) != -1) {
                w.write(buffer, 0, length);
            }

        } catch (IOException e) {
            System.err.print("IO Error");
        }
    }
}