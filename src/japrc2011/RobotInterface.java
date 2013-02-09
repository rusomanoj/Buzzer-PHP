package japrc2011;


public interface RobotInterface
{
    public enum Status {
        ACTIVE, DESTROYED
    }
    
    /** 
     * Returns the name of the robot.
     * 
     * @return the name of the robot
     */
    public String getName();
    
    /** 
     * Returns the status of the robot (active or destroyed)
     * 
     * @return the status of the robot in terms of the Status enum
     */
    public Status getStatus();
    
    /** 
     * Returns the current grid location of the robot
     * 
     * @return the grid location of the robot
     */
    public GridLocation getLocation();
    
    /** 
     * Tells the robot that one second of simulation time has passed
     * 
     */
    public void tick();
    
}
