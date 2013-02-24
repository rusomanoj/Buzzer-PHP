package japrc2011;


import java.util.ArrayList;

public interface SimulatorInterface
{
    /**
     * Adds a robot to the simulation.
     * 
     * @param robot The robot to be added
     * @throws RobotSimulationException if the robot object is not of a type supported by this simulation implementation
     */
    public void addRobot(RobotInterface robot);

    /**
     * Returns a list of the robots in the simulation
     * 
     * @param robot A list of the robots in the simulation
     */
    public ArrayList<Robot> getRobots();
    
    /**
     * Returns the object for a specific named robot. 
     * @param name the name of the robot
     * @return The named robot
     * @throws RobotSimulatorException if the named robot does not exist in the simulation 
     */
    public RobotInterface getRobot(String name);
    
    /**
     * Sends a command to a specified robot
     * 
     * @param robotName the name of the robot that will receive the command
     * @param commandString the text of the command itself
     * @throws RobotSimulatorException if the named robot does not exist in the simulation 
     * @throws RobotException  if the command string is not recognised by the robot as a valid command
     */
    public void sendCommand(String robotName, String commandString);
    
    /**
     * Gets the current state of the simulated world, including all robots and obstacles therein.
     * 
     * @return A 2D array of MapEntity objects, with dimensions equal to the dimensions of the simulated world. Empty locations are represented by null array entries. 
     */
    public MapEntity[][] getMapState();
    
    /**
     * Tells the simulator that it should notify the specified GUI whenever something changes in the simulated world that may require an update to the GUI. 
     * 
     * @param gui the gui that is to be notified of changes.
     */
    public void setGUI(SimGUIInterface gui);
    
    /**
     * Tells the simulator to move simulated time forward by one tick, and take any actions that should occur in that time. 
     */
    public void tick();
    
    /**
     * Returns the number of ticks since the simulation was started
     * @return the number of ticks since the simulation was started
     */
    public int getSimTime();
    
    /**
     * Gets the specified information from the named robot.
     * 
     * @param robotName the name of the robot to get the information from
     * @param infoName the type of information to request
     * @return the current value of the information
     * @throws RobotSimulatorException if the named robot does not exist in the simulation 
     * @throws RobotException if the command string is not recognised by the robot as a valid information type
     */
    public long getRobotInfo(String robotName, String infoName);
    
    /**
     * Adds a wall to the simulation in the specified location.
     * @param gridLocation the location that the wall should be placed at.
     * @throws RobotSimulatorException if the location is outside the bounds of the map, or if there is already an object at that location
     */
    public void addWall(GridLocation gridLocation);
    
    /**
     * Sets the size of the simulated world
     * 
     * @param x the width of the world, east to west, in grid squares
     * @param y the height of the world, north to south, in grid squares
     */
    public void setMapSize(int x, int y);
    
    /**
     * Gets the dimensions of the simulated world, in grid squares.
     * @return the dimensions of the world
     */
    public GridLocation getDimensions();
    
    /**
     * Moves the specified robot to the specified location, provided that the specified move is legal. If the move is not legal
     * the method returns with no effect.
     * 
     * @param robotName the name of the robot to move
     * @param newLoc the location to move the robot to
     */
    public void moveRobotTo(String robotName, GridLocation newLoc);
        
    /** 
     * Starts the simulator running continuously, at a rate of one tick per real-world second, and returns. 
     * If the simulator is already running, does nothing. 
     */
    public void start();
    
    /** 
     * If the simulator is currently running continuously (after a start()) command, this stops it running. 
     * If the simulator is not running, does nothing. 
     */
    public void stop();
}
