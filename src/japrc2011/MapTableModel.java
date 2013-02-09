package japrc2011;
import javax.swing.table.AbstractTableModel;


public class MapTableModel extends AbstractTableModel {
        String[] columnNames = {"","",""};
        Object [] [] currentMapView = {
                {"","",""},
                {"","",""},
                {"","",""},        
        };

        public int getColumnCount() {
            return columnNames.length;
        }

        public int getRowCount() {
            return currentMapView.length;
        }

        public String getColumnName(int col) {
            return columnNames[col];
        }

        public Object getValueAt(int row, int col) {
            return currentMapView[row][col];
        }

        public Class getColumnClass(int c) {
            return getValueAt(0, c).getClass();
        }
        
        public boolean isCellEditable(int row, int col) {
            return false;
        }

        public void setValueAt(Object value, int row, int col) {
            currentMapView[row][col] = value;
            fireTableCellUpdated(row, col);
        }        
        
        public void setAllCells(Object [] [] newMapView)
        {
            currentMapView = newMapView;
            fireTableDataChanged();
        }
}

