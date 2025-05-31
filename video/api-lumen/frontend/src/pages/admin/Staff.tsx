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

interface Staff {
  id: number;
  name: string;
  email: string;
  role: string;
  status: string;
}

function Staff() {
  const [staffList, setStaffList] = useState<Staff[]>([]);

  useEffect(() => {
    fetchStaff();
  }, []);

  const fetchStaff = async () => {
    try {
      const response = await axios.get('/admin/staff');
      setStaffList(response.data.data);
    } catch (error) {
      console.error('Error fetching staff:', error);
    }
  };

  return (
    <Box sx={{ p: 3 }}>
      <Box sx={{ display: 'flex', justifyContent: 'space-between', mb: 3 }}>
        <Typography variant="h4" gutterBottom>
          Staff Management
        </Typography>
        <Button variant="contained" color="primary">
          Add New Staff
        </Button>
      </Box>

      <TableContainer component={Paper}>
        <Table>
          <TableHead>
            <TableRow>
              <TableCell>Name</TableCell>
              <TableCell>Email</TableCell>
              <TableCell>Role</TableCell>
              <TableCell>Status</TableCell>
              <TableCell>Actions</TableCell>
            </TableRow>
          </TableHead>
          <TableBody>
            {staffList.map((staff) => (
              <TableRow key={staff.id}>
                <TableCell>{staff.name}</TableCell>
                <TableCell>{staff.email}</TableCell>
                <TableCell>
                  <Chip 
                    label={staff.role.toUpperCase()} 
                    color={staff.role === 'admin' ? 'error' : staff.role === 'manager' ? 'warning' : 'info'}
                  />
                </TableCell>
                <TableCell>
                  <Chip 
                    label={staff.status.toUpperCase()} 
                    color={staff.status === 'active' ? 'success' : 'error'}
                  />
                </TableCell>
                <TableCell>
                  <Button size="small" color="primary" sx={{ mr: 1 }}>
                    Edit
                  </Button>
                  <Button size="small" color="error">
                    Delete
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

export default Staff;