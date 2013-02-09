package japrc2011;


public final class MapEntity {
    
    public enum MapEntityType {
        WALL, ROBOT
    }
    
    private MapEntityType type;
    private String id;
    
    public MapEntity(MapEntityType type, String id)
    {
        this.type = type;
        this.id = id;
    }

    public MapEntityType getType()
    {
        return type;
    }

    public String getId()
    {
        return id;
    }         
    
    public String toString()
    {
        return "" + type.toString() + ": " + id;
    }
}