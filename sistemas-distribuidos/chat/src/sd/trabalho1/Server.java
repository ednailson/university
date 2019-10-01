package sd.trabalho1;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.io.Writer;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.ArrayList;
import javax.swing.JLabel;
import javax.swing.JOptionPane;
import javax.swing.JTextField;

public class Server extends Thread {
    private BufferedReader bfr;
    private static ArrayList<BufferedWriter> clients;
    private Socket con;
    private String name;
    private Server(Socket con) {
        InputStream is;
        InputStreamReader isr;
        this.con = con;
        try {
            is = con.getInputStream();
            isr = new InputStreamReader(is);
            bfr = new BufferedReader(isr);
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
    private void sendToAll(BufferedWriter bwSaida, String msg) throws IOException {
        BufferedWriter bwS;
        for (BufferedWriter bw : clients) {
            bwS = (BufferedWriter) bw;
            if (!(bwSaida == bwS)) {
                bw.write(name + " -> " + msg + "\r\n");
                bw.flush();
            }
        }
    }

    public void run() {
        try {
            String msg;
            OutputStream ou = this.con.getOutputStream();
            Writer ouw = new OutputStreamWriter(ou);
            BufferedWriter bfw = new BufferedWriter(ouw);
            clients.add(bfw);
            name = msg = bfr.readLine();

            while (!"Sair".equalsIgnoreCase(msg) && msg != null) {
                msg = bfr.readLine();
                sendToAll(bfw, msg);
                System.out.println(msg);
            }
        } catch (Exception e) {
            e.printStackTrace();

        }
    }

    public static void main(String[] args) {
        ServerSocket server;
        try {
            JLabel lblMessage = new JLabel("Porta do Servidor:");
            JTextField txtPorta = new JTextField("12345");
            Object[] texts = {lblMessage, txtPorta};
            JOptionPane.showMessageDialog(null, texts);
            server = new ServerSocket(Integer.parseInt(txtPorta.getText()));
            clients = new ArrayList<BufferedWriter>();
            JOptionPane.showMessageDialog(null, "Servidor ativo na porta: " +
                    txtPorta.getText());

            while (true) {
                System.out.println("Aguardando conexão...");
                Socket con = server.accept();
                System.out.println("Cliente conectado...");
                Thread t = new Server(con);
                t.start();
            }
        } catch (Exception e) {
            e.printStackTrace();
        }
    }
}