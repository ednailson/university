public class Student implements IHashable{
    private int registry;
    private String name;

    public int Hash(int tableSize){
        return this.registry%tableSize;
    }

    public void SetInfo(int r, String name) {
        this.name = name;
        this.registry = r;
    }

    public int GetRegistry() {
        return this.registry;
    }
    public String GetName() {
        return this.name;
    }
}
