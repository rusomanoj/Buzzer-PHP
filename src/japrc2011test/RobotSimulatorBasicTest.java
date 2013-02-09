package japrc2011test;


import static org.junit.Assert.assertEquals;
import static org.junit.Assert.assertNull;
import static org.junit.Assert.fail;
import japrc2011.MapEntity;
import japrc2011.Robot;
import japrc2011.RobotSimulator;
import japrc2011.RobotSimulatorException;
import japrc2011.SimGUIInterface;
import japrc2011.SimulatorInterface;
import japrc2011.MapEntity.MapEntityType;

import org.junit.Before;
import org.junit.Test;

public final class RobotSimulatorBasicTest
{
    private static final class MockSimGUI implements SimGUIInterface
    {
        public int changeCount;
        
        @Override
        public void notifySimHasChanged()
        {
            changeCount++;
        }
    }
    
    private SimulatorInterface rs;
    
    @Before
    public void setUp() throws Exception
    {
        rs = new RobotSimulator();
    }
       
    @Test
    public void testStartsEmpty() {        
        assertEquals(0, rs.getRobots().size()); 
    }
    
    @Test
    public void testAddRobot() {        
        rs.addRobot(new Robot("r1"));
        assertEquals(1, rs.getRobots().size()); 
    }
    
    @Test
    public void testGetRobotByName() {
        rs.addRobot(new Robot("r1"));
        rs.addRobot(new Robot("r2"));
        assertEquals("r1", rs.getRobot("r1").getName());
        assertEquals("r2", rs.getRobot("r2").getName());
    }
    
    @Test
    public void testGetInvalidRobotName() {
        rs.addRobot(new Robot("r1"));
        rs.addRobot(new Robot("r2"));
        try {
            rs.getRobot("invalid");
            fail();
        } catch (RobotSimulatorException e) 
        {            
        }
    }
    
    @Test
    public void testCommand() {
        rs.addRobot(new Robot("r1"));
        assertEquals(0, rs.getRobotInfo("r1", "COMMAND_COUNT"));
        
        rs.sendCommand("r1", "TEST");
        assertEquals(1, rs.getRobotInfo("r1", "COMMAND_COUNT"));    
    }
    
    @Test
    public void testCommandToNoRobot() {
        try {
            rs.sendCommand("invalid", "TEST");
            fail();
        } catch (RobotSimulatorException e) 
        {            
        }
    }
    
    @Test
    public void testMapEntityString() {
        MapEntity m = new MapEntity(MapEntityType.ROBOT, "r1");
        assertEquals("ROBOT: r1", m.toString());
    }
   
    
    @Test
    public void testGetMapStateEmpty() {
        MapEntity [] [] map = rs.getMapState();
        
        //all map squares should be empty
        for(int i=0; i<=2; ++i) {
            for(int j=0; j<=2; ++j) {
                assertEquals(null, map[i][j]);
            }  
        }         
    }

    @Test
    public void testGetMapStateWithRobot() {
        rs.addRobot(new Robot("r1"));
        MapEntity [] [] map = rs.getMapState();
        
        for(int i=0; i<=2; ++i) {
            for(int j=0; j<=2; ++j) {
                if(i==0 && j==0)
                {
                    //our robot should appear at location 0,0
                    assertEquals(MapEntityType.ROBOT, map[i][j].getType());
                    assertEquals("r1", map[i][j].getId());
                }
                else
                {
                    //other squares should be empty
                    assertEquals(null, map[i][j]);
                }
            }  
        }   
    }
    
    @Test
    public void testRobotMoveReflectedInMapState() {
        rs.addRobot(new Robot("r1"));
        MapEntity [] [] map = rs.getMapState();
        assertEquals(MapEntityType.ROBOT, map[0][0].getType());
        
        rs.sendCommand("r1", "M 1 0");
        rs.tick();
        map = rs.getMapState();
        assertNull(map[0][0]);
        assertEquals(MapEntityType.ROBOT, map[1][0].getType());        
    }
    
    @Test
    public void testNotifiesGUIOnCommand() {
        MockSimGUI gui = new MockSimGUI();        
        rs.setGUI(gui);      
        assertEquals(0, gui.changeCount);
        
        rs.addRobot(new Robot("r1"));
        assertEquals(1, gui.changeCount);
        
        rs.sendCommand("r1", "M 1 0");
        assertEquals(2, gui.changeCount);        
    }
    
}
