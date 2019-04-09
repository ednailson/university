import com.sun.istack.internal.NotNull;

public class SeparateChainingHashTable {
    private LinkedList[] lists;
    private static final int DEFAULT_TABLE_SIZE = 101;

    public int GetTableSize(){
        return DEFAULT_TABLE_SIZE;
    }

    public LinkedList[] GetList(){
        return this.lists;
    }

    public void SeparateChainingHashTable(int size) {
        this.lists = new LinkedList[size];
        for( int i=0; i<this.lists.length; i++ ){
            this.lists[i] = new LinkedList();
            this.lists[i].Init();
        }
    }

    public boolean Insert (@NotNull Student student) {
        return this.lists[student.GetRegistry()%this.GetTableSize()].Insert(student);
    }

    public boolean Remove (@NotNull Student student) {
        Student s  = this.Find(student);
        if (s == null) return false;
        return this.lists[student.GetRegistry()%this.GetTableSize()].Remove(s);
    }

    public Student Find (@NotNull Student student) {
        return this.lists[student.GetRegistry()%this.GetTableSize()].Find(student);
    }

    public void MakeEmpty() {
        for( int i=0; i<this.lists.length; i++ )
            this.lists[i].MakeEmpty();
    }

    public void PrintAll() {
        for( int i=0; i<this.lists.length; i++ ){
            System.out.print("[ " + i + " ]:  ");
            if (this.lists[i].HasItems()) this.lists[i].Print();
            System.out.println(" #");
        }

    }
}
