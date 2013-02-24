package japrc2011test;


import static org.junit.Assert.assertEquals;
import static org.junit.Assert.assertFalse;
import static org.junit.Assert.fail;
import japrc2011.GridLocation;
import japrc2011.Robot;
import japrc2011.RobotException;

import org.junit.Before;
import org.junit.Test;



public class RobotBasicTest
{
    Robot r;
    
    @Before
    public void setUp() throws Exception
    {
        r = new Robot("r1");
    }
    
   
    @Test
    public void testGetInfo() {
        assertEquals(0, r.getInfo("COMMAND_COUNT"));
        
        try {
            r.getInfo("invalid");
            fail();
        } catch (RobotException e) 
        {            
        }
        
    }
    
    @Test
    public void testCommandCount() {
        assertEquals(0, r.getInfo("COMMAND_COUNT"));
        r.receiveCommand("TEST");
        assertEquals(1, r.getInfo("COMMAND_COUNT"));
    }
    
    @Test
    public void testBadCommand() {
        try {
            r.receiveCommand("invalid");
            fail();
        } catch (RobotException e) 
        {            
        }
    }
    
    @Test
    public void testSelfDestruct() {
        assertEquals(Robot.Status.ACTIVE, r.getStatus());
        r.receiveCommand("SELF_DESTRUCT");
        r.tick();
        assertEquals(Robot.Status.DESTROYED, r.getStatus());        
    }
    

    
    @Test
    public void testGridLocations() {
        GridLocation g = new GridLocation(0,0);
        assertEquals(new GridLocation(0,0), g);
        GridLocation g2 = new GridLocation(17,2);
        assertEquals(new GridLocation(17,2), g2);
        assertFalse(g.equals(g2));
      
        
    }
    
    @Test
    public void testMove() {
        assertEquals(new GridLocation(0,0), r.getLocation());
        r.receiveCommand("M 1 0");
        r.tick();
        assertEquals(new GridLocation(1,0), r.getLocation());
        r.receiveCommand("M 0 2");
        r.tick();
        assertEquals(new GridLocation(1,2), r.getLocation());
    }
    
    @Test
    public void testGetName() {
        assertEquals("r1", r.getName());
        
    }
    
}
