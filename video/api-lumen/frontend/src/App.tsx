import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import { ThemeProvider, createTheme } from '@mui/material/styles';
import CssBaseline from '@mui/material/CssBaseline';
import Layout from './components/Layout';
import Login from './pages/auth/Login';
import Register from './pages/auth/Register';
import Dashboard from './pages/Dashboard';
import Menu from './pages/menu/Menu';
import Orders from './pages/orders/Orders';
import Customers from './pages/admin/Customers';
import Staff from './pages/admin/Staff';
import Reports from './pages/manager/Reports';
import { AuthProvider } from './contexts/AuthContext';

const theme = createTheme({
  palette: {
    primary: {
      main: '#1976d2',
    },
    secondary: {
      main: '#dc004e',
    },
  },
});

function App() {
  return (
    <ThemeProvider theme={theme}>
      <CssBaseline />
      <AuthProvider>
        <Router>
          <Routes>
            <Route path="/login" element={<Login />} />
            <Route path="/register" element={<Register />} />
            <Route path="/" element={<Layout />}>
              <Route index element={<Dashboard />} />
              <Route path="menu" element={<Menu />} />
              <Route path="orders" element={<Orders />} />
              <Route path="admin">
                <Route path="customers" element={<Customers />} />
                <Route path="staff" element={<Staff />} />
              </Route>
              <Route path="manager">
                <Route path="reports" element={<Reports />} />
              </Route>
            </Route>
          </Routes>
        </Router>
      </AuthProvider>
    </ThemeProvider>
  );
}

export default App;