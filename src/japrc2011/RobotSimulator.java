package japrc2011;

import japrc2011.MapEntity.MapEntityType;

import java.util.ArrayList;
import java.util.TreeMap;



public final class RobotSimulator implements SimulatorInterface
{

       
    private TreeMap<String, Robot> robots = new TreeMap<String, Robot>();
    private SimGUIInterface gui;
    
    private void notifyGUI()
    {
        if(gui != null)
        {
            gui.notifySimHasChanged();
        }
    }
    
    @Override
    public ArrayList<Robot> getRobots()
    {
        return new ArrayList<Robot>(robots.values());
    }

    @Override
    public void addRobot(RobotInterface robot)
    {
        Robot r;
        
        //this simulator only supports one concrete implementation of robot
        try
        {
            r = (Robot) robot;
        }
        catch (ClassCastException e)
        {
            throw new RobotSimulatorException("Unsupported robot implementation passed as parameter to addRobot()");
        }
        
        robots.put(r.getName(), r);
        notifyGUI();
    }
    
    @Override
    public void sendCommand(String robotName, String commandString)
    {
        Robot r = robots.get(robotName);
        
        
        if(r == null)
        {
            throw new RobotSimulatorException("Command sent to unknown robot: " + robotName);
        }
        
        r.receiveCommand(commandString); 
        notifyGUI();
    }

    @Override
    public long getRobotInfo(String robotName, String infoName)
    {
        Robot r = robots.get(robotName);
        
        
        if(r == null)
        {
            throw new RobotSimulatorException("Info requested from unknown robot: " + robotName);
        }
        
        return r.getInfo(infoName);
    }

    @Override
    public Robot getRobot(String name)
    {
        Robot r = robots.get(name);
        if(r != null)
        {
            return r;
        }
        else
        {
            throw new RobotSimulatorException("Unknown robot: " + name);
        }
    }

    @Override
    public MapEntity[][] getMapState()
    {
        MapEntity [] [] mapView = new MapEntity[3][3];
        
        for(Robot r: robots.values())
        {
            GridLocation g = r.getLocation();
            mapView[g.getX()][g.getY()] = new MapEntity(MapEntityType.ROBOT, r.getName());
        }
        
        return mapView;
    }

    @Override
    public void setGUI(SimGUIInterface gui)
    {
        this.gui = gui;
    }

    @Override
    public void addWall(japrc2011.GridLocation gridLocation)
    {
    }

    @Override
    public japrc2011.GridLocation getDimensions()
    {
        return null;
    }

    @Override
    public int getSimTime()
    {
        return 0;
    }

    @Override
    public void moveRobotTo(String robotName, japrc2011.GridLocation newLoc)
    {
    }

    @Override
    public void setMapSize(int x, int y)
    {
    }

    @Override
    public void tick()
    {
    }

    @Override
    public void start()
    {
    }

    @Override
    public void stop()
    {
    }

}
