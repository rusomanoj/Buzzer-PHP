package japrc2011;

public final class GridLocation {
    private int x;
    private int y;
    
    public GridLocation(int x, int y)
    {
        this.x = x;
        this.y = y;
    }
    
    public int getX()
    {
        return x;
    }
    public void setX(int x)
    {
        this.x = x;
    }
    public int getY()
    {
        return y;
    }
    public void setY(int y)
    {
        this.y = y;
    }
    
    public boolean equals(Object o)
    {
        if (o == this)
        {
            return true;
        }
        else 
        {
            if (o instanceof GridLocation)
            {
                GridLocation g = (GridLocation) o;
                if (this.x == g.x && this.y == g.y)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }else {
                return false;
            }
        }
    }
    
    public String toString()
    {
        return "(" + x + "," + y + ")";
    }
}