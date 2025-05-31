import { useState, useEffect } from 'react';
import {
  Typography,
  Box,
  Grid,
  Paper,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
} from '@mui/material';
import axios from '../../lib/axios';

interface SalesData {
  total_sales: number;
  total_orders: number;
  average_order: number;
}

interface TopMenuItem {
  menu: string;
  total_orders: number;
  revenue: number;
}

function Reports() {
  const [salesData, setSalesData] = useState<SalesData | null>(null);
  const [topItems, setTopItems] = useState<TopMenuItem[]>([]);

  useEffect(() => {
    fetchReportData();
  }, []);

  const fetchReportData = async () => {
    try {
      const [salesResponse, topItemsResponse] = await Promise.all([
        axios.get('/manager/reports/sales'),
        axios.get('/manager/reports/top-items')
      ]);
      
      setSalesData(salesResponse.data.data);
      setTopItems(topItemsResponse.data.data);
    } catch (error) {
      console.error('Error fetching report data:', error);
    }
  };

  return (
    <Box sx={{ p: 3 }}>
      <Typography variant="h4" gutterBottom>
        Sales Reports
      </Typography>

      <Grid container spacing={3} sx={{ mb: 4 }}>
        <Grid item xs={12} md={4}>
          <Paper sx={{ p: 3, textAlign: 'center' }}>
            <Typography variant="h6" gutterBottom>
              Total Sales
            </Typography>
            <Typography variant="h4">
              Rp {salesData?.total_sales?.toLocaleString() ?? 0}
            </Typography>
          </Paper>
        </Grid>
        <Grid item xs={12} md={4}>
          <Paper sx={{ p: 3, textAlign: 'center' }}>
            <Typography variant="h6" gutterBottom>
              Total Orders
            </Typography>
            <Typography variant="h4">
              {salesData?.total_orders ?? 0}
            </Typography>
          </Paper>
        </Grid>
        <Grid item xs={12} md={4}>
          <Paper sx={{ p: 3, textAlign: 'center' }}>
            <Typography variant="h6" gutterBottom>
              Average Order Value
            </Typography>
            <Typography variant="h4">
              Rp {salesData?.average_order?.toLocaleString() ?? 0}
            </Typography>
          </Paper>
        </Grid>
      </Grid>

      <Typography variant="h5" gutterBottom sx={{ mt: 4 }}>
        Top Selling Items
      </Typography>
      
      <TableContainer component={Paper}>
        <Table>
          <TableHead>
            <TableRow>
              <TableCell>Menu Item</TableCell>
              <TableCell align="right">Total Orders</TableCell>
              <TableCell align="right">Revenue</TableCell>
            </TableRow>
          </TableHead>
          <TableBody>
            {topItems.map((item) => (
              <TableRow key={item.menu}>
                <TableCell>{item.menu}</TableCell>
                <TableCell align="right">{item.total_orders}</TableCell>
                <TableCell align="right">Rp {item.revenue.toLocaleString()}</TableCell>
              </TableRow>
            ))}
          </TableBody>
        </Table>
      </TableContainer>
    </Box>
  );
}

export default Reports;