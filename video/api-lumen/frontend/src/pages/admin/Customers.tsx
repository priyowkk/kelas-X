import { useState, useEffect } from 'react';
import {
  Typography,
  Box,
  Table,
  TableBody,
  TableCell,
  TableContainer,
  TableHead,
  TableRow,
  Paper,
  Button,
  Chip
} from '@mui/material';
import axios from '../../lib/axios';

interface Customer {
  id: number;
  nama: string;
  email: string;
  alamat: string;
  telp: string;
  status: string;
}

function Customers() {
  const [customers, setCustomers] = useState<Customer[]>([]);

  useEffect(() => {
    fetchCustomers();
  }, []);

  const fetchCustomers = async () => {
    try {
      const response = await axios.get('/admin/pelanggan');
      setCustomers(response.data.data);
    } catch (error) {
      console.error('Error fetching customers:', error);
    }
  };

  return (
    <Box sx={{ p: 3 }}>
      <Box sx={{ display: 'flex', justifyContent: 'space-between', mb: 3 }}>
        <Typography variant="h4" gutterBottom>
          Customer Management
        </Typography>
      </Box>

      <TableContainer component={Paper}>
        <Table>
          <TableHead>
            <TableRow>
              <TableCell>Name</TableCell>
              <TableCell>Email</TableCell>
              <TableCell>Address</TableCell>
              <TableCell>Phone</TableCell>
              <TableCell>Status</TableCell>
              <TableCell>Actions</TableCell>
            </TableRow>
          </TableHead>
          <TableBody>
            {customers.map((customer) => (
              <TableRow key={customer.id}>
                <TableCell>{customer.nama}</TableCell>
                <TableCell>{customer.email}</TableCell>
                <TableCell>{customer.alamat}</TableCell>
                <TableCell>{customer.telp}</TableCell>
                <TableCell>
                  <Chip 
                    label={customer.status.toUpperCase()} 
                    color={customer.status === 'aktif' ? 'success' : 'error'}
                  />
                </TableCell>
                <TableCell>
                  <Button size="small" color="primary" sx={{ mr: 1 }}>
                    View Orders
                  </Button>
                  <Button size="small" color="error">
                    Block
                  </Button>
                </TableCell>
              </TableRow>
            ))}
          </TableBody>
        </Table>
      </TableContainer>
    </Box>
  );
}

export default Customers;