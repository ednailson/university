package sd.trabalho1;

import java.awt.Color;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.io.Writer;
import java.net.Socket;
import javax.swing.*;

public class Client extends JFrame implements ActionListener, KeyListener {
    private JTextArea text;
    private static final long serialVersionUID = 1L;
    private JButton btnSend;
    private JTextField txtPort;
    private JButton btnClose;
    private JTextField txtMsg;
    private OutputStream ou;
    private JTextField txtIP;
    private Socket socket;
    private BufferedWriter bfw;
    private JTextField txtNome;
    private Writer ouw;

    private Client() {
        JLabel JLHistoric;
        JLabel lblMsg;
        JPanel pnlContent;
        JLabel lblMessage = new JLabel("Verificar!");
        txtIP = new JTextField("127.0.0.1");
        txtPort = new JTextField("12345");
        txtNome = new JTextField("Cliente");
        Object[] texts = {lblMessage, txtIP, txtPort, txtNome};
        JOptionPane.showMessageDialog(null, texts);
        pnlContent = new JPanel();
        text = new JTextArea(10, 20);
        text.setEditable(false);
        text.setBackground(new Color(240, 240, 240));
        txtMsg = new JTextField(20);
        JLHistoric = new JLabel("Histórico");
        lblMsg = new JLabel("Mensagem");
        btnSend = new JButton("Enviar");
        btnSend.setToolTipText("Enviar Mensagem");
        btnClose = new JButton("Sair");
        btnClose.setToolTipText("Sair do Chat");
        btnSend.addActionListener(this);
        btnClose.addActionListener(this);
        btnSend.addKeyListener(this);
        txtMsg.addKeyListener(this);
        JScrollPane scroll = new JScrollPane(text);
        text.setLineWrap(true);
        pnlContent.add(JLHistoric);
        pnlContent.add(scroll);
        pnlContent.add(lblMsg);
        pnlContent.add(txtMsg);
        pnlContent.add(btnClose);
        pnlContent.add(btnSend);
        pnlContent.setBackground(Color.LIGHT_GRAY);
        text.setBorder(BorderFactory.createEtchedBorder(Color.BLUE, Color.BLUE));
        txtMsg.setBorder(BorderFactory.createEtchedBorder(Color.BLUE, Color.BLUE));
        setTitle(txtNome.getText());
        setContentPane(pnlContent);
        setLocationRelativeTo(null);
        setResizable(false);
        setSize(250, 300);
        setVisible(true);
        setDefaultCloseOperation(EXIT_ON_CLOSE);
    }

    private void connect() throws IOException {
        socket = new Socket(txtIP.getText(), Integer.parseInt(txtPort.getText()));
        ou = socket.getOutputStream();
        ouw = new OutputStreamWriter(ou);
        bfw = new BufferedWriter(ouw);
        bfw.write(txtNome.getText() + "\r\n");
        bfw.flush();
    }

    private void sendMessage(String msg) throws IOException {
        if (msg.equals("Sair")) {
            bfw.write("Desconectado \r\n");
            text.append("Desconectado \r\n");
        } else {
            bfw.write(msg + "\r\n");
            text.append(txtNome.getText() + " diz -> " + txtMsg.getText() + "\r\n");
        }
        bfw.flush();
        txtMsg.setText("");
    }

    private void listening() throws IOException {
        InputStream in = socket.getInputStream();
        InputStreamReader inr = new InputStreamReader(in);
        BufferedReader bfr = new BufferedReader(inr);
        String msg = "";
        while (!"Sair".equalsIgnoreCase(msg))
            if (bfr.ready()) {
                msg = bfr.readLine();
                if (msg.equals("Sair"))
                    text.append("Servidor caiu! \r\n");
                else
                    text.append(msg + "\r\n");
            }
    }

    private void close() throws IOException {
        sendMessage("Sair");
        bfw.close();
        ouw.close();
        ou.close();
        socket.close();
    }

    @Override
    public void actionPerformed(ActionEvent e) {

        try {
            if (e.getActionCommand().equals(btnSend.getActionCommand()))
                sendMessage(txtMsg.getText());
            else if (e.getActionCommand().equals(btnClose.getActionCommand()))
                close();
        } catch (IOException e1) {
            // TODO Auto-generated catch block
            e1.printStackTrace();
        }
    }

    @Override
    public void keyPressed(KeyEvent e) {

        if (e.getKeyCode() == KeyEvent.VK_ENTER) {
            try {
                sendMessage(txtMsg.getText());
            } catch (IOException e1) {
                // TODO Auto-generated catch block
                e1.printStackTrace();
            }
        }
    }

    @Override
    public void keyReleased(KeyEvent arg0) {
        // TODO Auto-generated method stub
    }

    @Override
    public void keyTyped(KeyEvent arg0) {
        // TODO Auto-generated method stub
    }

    public static void main(String[] args) throws IOException {
        Client app = new Client();
        app.connect();
        app.listening();
    }
}
