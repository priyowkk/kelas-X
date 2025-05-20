// CSS sekarang diimpor dari public/style.css
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Navbar from './pages/Navbar';
import Home from './pages/Home';
import Kontak from './pages/Kontak';
import Nav from './pages/Nav';
import Sejarah from './pages/Sejarah';
import Tentang from './pages/Tentang';
import Siswa from './pages/Siswa';
import Menu from './pages/Menu';

function App() {
  return (
    <Router>
      <div className="App">
        <Navbar />
        <div className="content">
          <Routes>
            <Route path="/" element={<Home />}exact />
            <Route path="/kontak" element={<Kontak />} />
            <Route path="/nav" element={<Nav />} />
            <Route path="/sejarah" element={<Sejarah />} />
            <Route path="/tentang" element={<Tentang />} />
            <Route path="/siswa" element={<Siswa />} />
            <Route path="/menu" element={<Menu />} />
          </Routes>
        </div>
      </div>
    </Router>
  );
}

export default App;
