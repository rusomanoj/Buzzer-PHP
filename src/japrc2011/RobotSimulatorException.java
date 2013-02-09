package japrc2011;

public final class RobotSimulatorException extends RuntimeException
{
    private String msg;

    public RobotSimulatorException(String message){
        this.msg = message;
    }
    
    public String toString(){
        return msg;
    }
}
