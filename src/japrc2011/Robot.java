package japrc2011;

public final class Robot implements RobotInterface
{
    private long commandCount = 0;
    private String name;
    
    private Status currentStatus = Status.ACTIVE;
    
    private GridLocation loc = new GridLocation(0,0);
    

    public Robot(String name)
    {
        this.name = name;
    }
    
    
    public long getInfo(String string)
    {
        if(string.equals("COMMAND_COUNT"))
        {
            return commandCount;
        }
        else
        {
            throw new RobotException("Invalid info item name");
        }
    }

    public void receiveCommand(String commandString)
    {
        commandCount++;
                
        if(commandString.equals("SELF_DESTRUCT"))
        {
            currentStatus = Status.DESTROYED;
        }
        else if (commandString.startsWith("M"))
        {          
            String[] com = commandString.split(" ");
            
            if(com.length != 3)
            {
                throw new RobotException("Invalid command string");
            }
            else
            {
                int xChange = Integer.parseInt(com[1]);
                int yChange = Integer.parseInt(com[2]);
                loc.setX( loc.getX() + xChange );
                loc.setY( loc.getY() + yChange );
            }            
        }
        else if (commandString.equals("TEST")) {
            //do nothing
        }
        else
        {
            throw new RobotException("Invalid command string");
        }
    }

    public Status getStatus()
    {
        return currentStatus;
    }

    public GridLocation getLocation()
    {
        return loc;
    }
    
    public void setLocation(GridLocation newLoc)
    {
        loc = newLoc; 
    }

    public String getName()
    {
        return name;
    }


    @Override
    public void tick()
    {
    }

}
