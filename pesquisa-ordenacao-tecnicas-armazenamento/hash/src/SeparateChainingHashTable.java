public class SeparateChainingHashTable {
    private LinkedList[] lists;
    private static final int DEFAULT_TABLE_SIZE = 101;

    public int GetTableSize(){
        return this.DEFAULT_TABLE_SIZE;
    }

    public LinkedList[] GetList(){
        return this.lists;
    }

    public void SeparateChainingHashTable(int size) {
        this.lists = new LinkedList[size];
        for( int i=0; i<this.lists.length; i++ )
            this.lists[i] = new LinkedList();
    }

    public void MakeEmpty() {
        for( int i=0; i<this.lists.length; i++ )
            this.lists[i].MakeEmpty();
    }
}
