package japrc2011;

public interface SimGUIInterface
{
    /** 
     * Tells the GUI that something about simulation has changed (and hence the GUI may need to redraw itself) 
     * 
     */
    void notifySimHasChanged();
}
