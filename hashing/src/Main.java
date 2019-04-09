import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;
import java.util.Scanner;

public class Main {

    public static void main(String[] args) {
        String csvFile = "C:\\Users\\ednai\\Git\\university.activities\\hashing\\data.csv";
        BufferedReader br = null;
        String line;
        String cvsSplitBy = ";";
        SeparateChainingHashTable studentList = new SeparateChainingHashTable();
        int tableSize = studentList.GetTableSize();
        studentList.SeparateChainingHashTable(tableSize);
        try {
            br = new BufferedReader(new FileReader(csvFile));
            while ((line = br.readLine()) != null) {
                String[] st = line.split(cvsSplitBy);
                Student student = new Student();
                student.SetInfo(Integer.parseInt(st[0]), st[1]);
                studentList.Insert(student);
            }
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        } finally {
            if (br != null) {
                try {
                    br.close();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
        }
        while (true) {
            System.out.println("# MENU #");
            System.out.println("-- OPÇÕES --");
            System.out.println("1 - Imprimir o HASH");
            System.out.println("2 - Inserir estudante");
            System.out.println("3 - Remover estudante");
            System.out.println("4 - Limpar todo o hash");
            Scanner scanner = new Scanner(System.in);
            int option = scanner.nextInt();
            switch (option) {
                case 1:
                    System.out.println("\n\n");
                    studentList.PrintAll();
                    System.out.println("\n\n");
                    break;
                case 2:
                    System.out.println("Insira a matricula(numero inteiro)");
                    int registry = scanner.nextInt();
                    System.out.println("Insira o nome");
                    String name = scanner.next();
                    Student s = new Student();
                    s.SetInfo(registry, name);
                    if (studentList.Insert(s)){
                        System.out.println("Estudante inserido com sucesso");
                    } else {
                        System.out.println("Estudante não pode ser inserido");
                    }
                    break;
                case 3:
                    System.out.println("Insira a matricula(numero inteiro)");
                    int r = scanner.nextInt();
                    System.out.println("Insira o nome");
                    String n = scanner.next();
                    Student s2 = new Student();
                    s2.SetInfo(r, n);
                    if (studentList.Remove(s2)){
                        System.out.println("Estudante removido com sucesso");
                    } else {
                        System.out.println("Estudante não foi removido");
                    }
                    break;
                case 4:
                    studentList.MakeEmpty();
                    break;
            }
        }
    }
}
