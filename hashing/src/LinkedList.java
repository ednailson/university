public class LinkedList {
    private java.util.LinkedList<Student> list;

    public void Init () {
        this.list = new java.util.LinkedList<Student>();
    }

    public boolean HasItems() {
        return this.list.size() > 0 ;
    }

    public boolean Insert (Student student) {
        return this.list.add(student);
    }

    public boolean Remove (Student student) {
        return this.list.remove(student);
    }

    public Student Find (Student student) {
        for (int i = 0; i < this.list.size(); i++) {
            Student s = this.list.get(i);
            if (s.GetName().equals(student.GetName()) && s.GetRegistry() == student.GetRegistry()) return s;
        }
        return null;
    }

    public void Print () {
        for (int i = 0; i < this.list.size(); i++) {
            Student s = this.list.get(i);
            System.out.print("[" + s.GetRegistry() + "] " + s.GetName() + " ->  ");
            if (i == this.list.size() - 1) System.out.print("NULL");
        }
    }

    public void MakeEmpty() {
        this.list.clear();
    }
}
