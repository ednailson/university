public class Main {

    public static void main(String[] args) {
        Student st = new Student();
        st.SetInfo(149131051, "Junior");
        st.SetNext(null);
        System.out.println("Nome: " + st.GetName());
        System.out.println("Matricula: " + st.GetRegistry());
        LinkedList list = new LinkedList();
        list.Init();
        list.Insert(st);
        list.Print();
        list.Remove(st);
        list.Print();
        SeparateChainingHashTable hashTable = new SeparateChainingHashTable();
        hashTable.GetTableSize();
    }

}
