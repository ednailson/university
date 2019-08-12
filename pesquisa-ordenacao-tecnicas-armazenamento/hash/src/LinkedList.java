public class LinkedList {
    private java.util.LinkedList<Student> list;

    public void Init () {
        this.list = new java.util.LinkedList<Student>();
    }

    public boolean Insert (Student student) {
        return this.list.add(student);
    }

    public boolean Remove (Student student) {
        return this.list.remove(student);
    }

    public void Print () {
        System.out.println("Vai monstro" + this.list);
    }

    public void MakeEmpty() {
        this.list.clear();
    }
}
