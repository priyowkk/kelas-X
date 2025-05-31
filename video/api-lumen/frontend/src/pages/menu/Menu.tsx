import { useState, useEffect } from 'react';
import {
  Grid,
  Card,
  CardMedia,
  CardContent,
  Typography,
  CardActions,
  Button,
  Box,
  TextField,
  MenuItem,
  FormControl,
  InputLabel,
  Select,
} from '@mui/material';
import axios from '../../lib/axios';

interface Menu {
  idmenu: number;
  menu: string;
  deskripsi: string;
  harga: number;
  foto: string;
  idkategori: number;
  status: string;
  kategori?: {
    idkategori: number;
    kategori: string;
  };
}

interface Kategori {
  idkategori: number;
  kategori: string;
}

function Menu() {
  const [menus, setMenus] = useState<Menu[]>([]);
  const [categories, setCategories] = useState<Kategori[]>([]);
  const [selectedCategory, setSelectedCategory] = useState<string>('');
  const [searchQuery, setSearchQuery] = useState<string>('');

  useEffect(() => {
    fetchMenus();
    fetchCategories();
  }, []);

  const fetchMenus = async () => {
    try {
      const response = await axios.get('/menus');
      setMenus(response.data.data);
    } catch (error) {
      console.error('Error fetching menus:', error);
    }
  };

  const fetchCategories = async () => {
    try {
      const response = await axios.get('/categories');
      setCategories(response.data.data);
    } catch (error) {
      console.error('Error fetching categories:', error);
    }
  };

  const filteredMenus = menus.filter((menu) => {
    const matchesCategory = !selectedCategory || menu.idkategori.toString() === selectedCategory;
    const matchesSearch = menu.menu.toLowerCase().includes(searchQuery.toLowerCase()) ||
                         menu.deskripsi.toLowerCase().includes(searchQuery.toLowerCase());
    return matchesCategory && matchesSearch;
  });

  return (
    <Box sx={{ p: 3 }}>
      <Typography variant="h4" gutterBottom>
        Menu
      </Typography>
      
      <Box sx={{ mb: 3, display: 'flex', gap: 2 }}>
        <TextField
          label="Search Menu"
          variant="outlined"
          value={searchQuery}
          onChange={(e) => setSearchQuery(e.target.value)}
          sx={{ width: 300 }}
        />
        <FormControl sx={{ width: 200 }}>
          <InputLabel>Category</InputLabel>
          <Select
            value={selectedCategory}
            label="Category"
            onChange={(e) => setSelectedCategory(e.target.value)}
          >
            <MenuItem value="">All Categories</MenuItem>
            {categories.map((category) => (
              <MenuItem key={category.idkategori} value={category.idkategori.toString()}>
                {category.kategori}
              </MenuItem>
            ))}
          </Select>
        </FormControl>
      </Box>

      <Grid container spacing={3}>
        {filteredMenus.map((menu) => (
          <Grid item xs={12} sm={6} md={4} lg={3} key={menu.idmenu}>
            <Card>
              <CardMedia
                component="img"
                height="200"
                image={menu.foto || 'https://via.placeholder.com/300x200'}
                alt={menu.menu}
              />
              <CardContent>
                <Typography gutterBottom variant="h6" component="div">
                  {menu.menu}
                </Typography>
                <Typography variant="body2" color="text.secondary">
                  {menu.deskripsi}
                </Typography>
                <Typography variant="h6" color="primary" sx={{ mt: 1 }}>
                  Rp {menu.harga.toLocaleString()}
                </Typography>
                <Typography variant="caption" color="text.secondary" display="block">
                  Category: {menu.kategori?.kategori}
                </Typography>
              </CardContent>
              <CardActions>
                <Button size="small" variant="contained" fullWidth>
                  Add to Order
                </Button>
              </CardActions>
            </Card>
          </Grid>
        ))}
      </Grid>
    </Box>
  );
}

export default Menu;