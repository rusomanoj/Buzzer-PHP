package japrc2011;


import java.awt.FlowLayout;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JTable;
import javax.swing.SwingUtilities;

public final class RobotSimulatorGUI extends JFrame implements SimGUIInterface
{
    private JButton southButton;
    private JButton exitButton;

    private JTable mapView;
    private MapTableModel mapTableModel;
    
    private RobotSimulator sim;
    
    public RobotSimulatorGUI(RobotSimulator simToUse)
    {
        super("Robot Simulator GUI");
        setLayout(new FlowLayout());
     
        this.sim = simToUse;
        
        southButton = new JButton("South");
        southButton.addActionListener(new ActionListener() {            
            @Override
            public void actionPerformed(ActionEvent arg0)
            {
                sim.sendCommand("r1", "M 0 1");
            }
        });
        add(southButton);
        
        exitButton = new JButton("Exit Program");
        exitButton.addActionListener(new ActionListener() {            
            @Override
            public void actionPerformed(ActionEvent arg0)
            {
                System.exit(0);               
            }
        });
        add(exitButton);
        
        mapTableModel = new MapTableModel();
        mapView = new JTable(mapTableModel);
        add(mapView);
        updateMap();
        
    }
    
    public void updateMap()
    {
        MapEntity[][] newMapView = sim.getMapState();
        
        //TODO: make this cope with a map of any size
        for(int i=0; i<=2; ++i) {
            for(int j=0; j<=2; ++j) {
                //translate from the (col,row) view used by the sim to the (row,col) view used by JTable
                MapEntity m = newMapView[i][j];
                if(m==null)
                {
                    mapTableModel.setValueAt("", j, i);    
                }
                else
                {
                    mapTableModel.setValueAt(m, j, i);
                }
            }
            
        }
    }
    
    
    public static void main(String[] args)
    {
        RobotSimulator sim = new RobotSimulator();        
        sim.addRobot(new Robot("r1"));
        
        RobotSimulatorGUI gui = new RobotSimulatorGUI(sim);
        gui.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        gui.setSize(275,180);
        
        sim.setGUI(gui);
                
        gui.setVisible(true);
    }

    @Override
    public void notifySimHasChanged()
    {
        SwingUtilities.invokeLater(new Runnable() {
            public void run() {
                updateMap();
            }
        });
    }

}
