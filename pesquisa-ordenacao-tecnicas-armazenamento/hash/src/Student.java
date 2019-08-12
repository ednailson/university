public class Student implements IHashable{
    private int registry;
    private String name;
    private Student next;

    public int Hash(int tableSize){
        return this.registry%tableSize;
    }

    public void SetInfo(int r, String name) {
        this.name = name;
        this.registry = r;
    }

    public void SetNext (Student student){
        this.next = student;
    }

    public int GetRegistry() {
        return this.registry;
    }

    public Student GetNext() {
        return this.next;
    }

    public String GetName() {
        return this.name;
    }
}
