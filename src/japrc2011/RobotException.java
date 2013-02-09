package japrc2011;

public final class RobotException extends RuntimeException
{
    private String msg;

    public RobotException(String message){
        this.msg = message;
    }
    
    public String toString(){
        return msg;
    }
}
