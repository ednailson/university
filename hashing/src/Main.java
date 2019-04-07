import com.sun.deploy.util.Waiter;

import javax.management.timer.Timer;
import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.IOException;

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
                studentList.InsertItem(student, student.GetRegistry()%tableSize);
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

        LinkedList[] list = studentList.GetList();
        list[1].Print();
//        Student st = new Student();
//        st.SetInfo(149131051, "Junior");
//        st.SetNext(null);
//        System.out.println("Nome: " + st.GetName());
//        System.out.println("Matricula: " + st.GetRegistry());
//        LinkedList list = new LinkedList();
//        list.Init();
//        list.Insert(st);
//        list.Print();
//        list.Remove(st);
//        list.Print();
//        SeparateChainingHashTable hashTable = new SeparateChainingHashTable();
//        hashTable.GetTableSize();

    }
}
