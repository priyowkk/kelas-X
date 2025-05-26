import React, { useState, useEffect } from 'react';
import { Trash2, UserX, UserCheck, Plus, Search, Shield, Menu, Users, Settings } from 'lucide-react';

const AdminDashboard = () => {
  // State untuk data
  const [users, setUsers] = useState([]);
  const [menuItems, setMenuItems] = useState([]);
  const [activeTab, setActiveTab] = useState('users');
  const [searchTerm, setSearchTerm] = useState('');
  const [showDeleteModal, setShowDeleteModal] = useState(false);
  const [showDeactivateModal, setShowDeactivateModal] = useState(false);
  const [selectedItem, setSelectedItem] = useState(null);
  const [loading, setLoading] = useState(false);

  // Data dummy untuk demo
  useEffect(() => {
    // Simulasi data users dari database
    setUsers([
      { id: 1, username: 'user1', is_active: 1, created_at: '2024-01-15 10:30:00' },
      { id: 2, username: 'user2', is_active: 1, created_at: '2024-01-20 14:22:00' },
      { id: 3, username: 'user3', is_active: 0, created_at: '2024-02-01 09:15:00' },
      { id: 4, username: 'admin', is_active: 1, created_at: '2024-01-01 08:00:00' },
      { id: 5, username: 'user4', is_active: 1, created_at: '2024-02-10 16:45:00' }
    ]);

    // Simulasi data menu
    setMenuItems([
      { id: 1, name: 'Dashboard', path: '/dashboard', icon: 'dashboard' },
      { id: 2, name: 'Products', path: '/products', icon: 'shopping-bag' },
      { id: 3, name: 'Orders', path: '/orders', icon: 'shopping-cart' },
      { id: 4, name: 'Reports', path: '/reports', icon: 'bar-chart' },
      { id: 5, name: 'Settings', path: '/settings', icon: 'settings' }
    ]);
  }, []);

  // Filter data berdasarkan search
  const filteredUsers = users.filter(user => 
    user.username.toLowerCase().includes(searchTerm.toLowerCase())
  );

  const filteredMenuItems = menuItems.filter(item => 
    item.name.toLowerCase().includes(searchTerm.toLowerCase())
  );

  // Fungsi untuk toggle status aktif user
  const toggleUserStatus = async (userId) => {
    setLoading(true);
    try {
      // Simulasi API call
      await new Promise(resolve => setTimeout(resolve, 1000));
      
      setUsers(prevUsers => 
        prevUsers.map(user => 
          user.id === userId 
            ? { ...user, is_active: user.is_active === 1 ? 0 : 1 }
            : user
        )
      );
      setShowDeactivateModal(false);
      setSelectedItem(null);
    } catch (error) {
      console.error('Error updating user status:', error);
    } finally {
      setLoading(false);
    }
  };

  // Fungsi untuk menghapus menu
  const deleteMenuItem = async (menuId) => {
    setLoading(true);
    try {
      // Simulasi API call
      await new Promise(resolve => setTimeout(resolve, 1000));
      
      setMenuItems(prevItems => 
        prevItems.filter(item => item.id !== menuId)
      );
      setShowDeleteModal(false);
      setSelectedItem(null);
    } catch (error) {
      console.error('Error deleting menu item:', error);
    } finally {
      setLoading(false);
    }
  };

  // Modal konfirmasi
  const ConfirmModal = ({ show, onClose, onConfirm, title, message, type = 'danger' }) => {
    if (!show) return null;

    return (
      <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div className="bg-white rounded-lg p-6 max-w-md w-full mx-4">
          <h3 className="text-lg font-semibold mb-4 text-gray-900">{title}</h3>
          <p className="text-gray-600 mb-6">{message}</p>
          <div className="flex justify-end space-x-3">
            <button 
              onClick={onClose}
              className="px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-50 transition-colors"
              disabled={loading}
            >
              Batal
            </button>
            <button 
              onClick={onConfirm}
              disabled={loading}
              className={`px-4 py-2 rounded-md text-white transition-colors ${
                type === 'danger' 
                  ? 'bg-red-600 hover:bg-red-700' 
                  : 'bg-blue-600 hover:bg-blue-700'
              } ${loading ? 'opacity-50 cursor-not-allowed' : ''}`}
            >
              {loading ? 'Loading...' : 'Konfirmasi'}
            </button>
          </div>
        </div>
      </div>
    );
  };

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <header className="bg-white shadow-sm border-b">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center h-16">
            <div className="flex items-center space-x-3">
              <Shield className="h-8 w-8 text-blue-600" />
              <h1 className="text-xl font-bold text-gray-900">Admin Dashboard</h1>
            </div>
            <div className="flex items-center space-x-4">
              <span className="text-sm text-gray-600">Selamat datang, Admin</span>
              <div className="h-8 w-8 bg-blue-600 rounded-full flex items-center justify-center">
                <span className="text-white text-sm font-medium">A</span>
              </div>
            </div>
          </div>
        </div>
      </header>

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* Navigation Tabs */}
        <div className="mb-6">
          <div className="border-b border-gray-200">
            <nav className="-mb-px flex space-x-8">
              <button
                onClick={() => setActiveTab('users')}
                className={`py-2 px-1 border-b-2 font-medium text-sm ${
                  activeTab === 'users'
                    ? 'border-blue-500 text-blue-600'
                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                }`}
              >
                <Users className="inline-block w-4 h-4 mr-2" />
                Kelola Pengguna
              </button>
              <button
                onClick={() => setActiveTab('menu')}
                className={`py-2 px-1 border-b-2 font-medium text-sm ${
                  activeTab === 'menu'
                    ? 'border-blue-500 text-blue-600'
                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                }`}
              >
                <Menu className="inline-block w-4 h-4 mr-2" />
                Kelola Menu
              </button>
            </nav>
          </div>
        </div>

        {/* Search Bar */}
        <div className="mb-6">
          <div className="relative max-w-md">
            <Search className="absolute left-3 top-1/2 transform -translate-y-1/2 h-4 w-4 text-gray-400" />
            <input
              type="text"
              placeholder={`Cari ${activeTab === 'users' ? 'pengguna' : 'menu'}...`}
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent w-full"
            />
          </div>
        </div>

        {/* Content */}
        <div className="bg-white rounded-lg shadow">
          {activeTab === 'users' ? (
            <div>
              {/* Users Table Header */}
              <div className="px-6 py-4 border-b border-gray-200">
                <h2 className="text-lg font-medium text-gray-900">Daftar Pengguna</h2>
                <p className="text-sm text-gray-600">Kelola status aktif pengguna dalam sistem</p>
              </div>

              {/* Users Table */}
              <div className="overflow-x-auto">
                <table className="min-w-full divide-y divide-gray-200">
                  <thead className="bg-gray-50">
                    <tr>
                      <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                      <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Username</th>
                      <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                      <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dibuat</th>
                      <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                  </thead>
                  <tbody className="bg-white divide-y divide-gray-200">
                    {filteredUsers.map((user) => (
                      <tr key={user.id} className="hover:bg-gray-50">
                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{user.id}</td>
                        <td className="px-6 py-4 whitespace-nowrap">
                          <div className="flex items-center">
                            <div className="h-8 w-8 bg-gray-300 rounded-full flex items-center justify-center mr-3">
                              <span className="text-gray-600 text-sm font-medium">
                                {user.username.charAt(0).toUpperCase()}
                              </span>
                            </div>
                            <span className="text-sm font-medium text-gray-900">{user.username}</span>
                          </div>
                        </td>
                        <td className="px-6 py-4 whitespace-nowrap">
                          <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                            user.is_active === 1 
                              ? 'bg-green-100 text-green-800' 
                              : 'bg-red-100 text-red-800'
                          }`}>
                            {user.is_active === 1 ? 'Aktif' : 'Nonaktif'}
                          </span>
                        </td>
                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                          {new Date(user.created_at).toLocaleDateString('id-ID')}
                        </td>
                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                          {user.username !== 'admin' && (
                            <button
                              onClick={() => {
                                setSelectedItem(user);
                                setShowDeactivateModal(true);
                              }}
                              className={`inline-flex items-center px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md ${
                                user.is_active === 1
                                  ? 'text-red-700 bg-red-100 hover:bg-red-200'
                                  : 'text-green-700 bg-green-100 hover:bg-green-200'
                              } transition-colors`}
                            >
                              {user.is_active === 1 ? (
                                <>
                                  <UserX className="w-4 h-4 mr-1" />
                                  Nonaktifkan
                                </>
                              ) : (
                                <>
                                  <UserCheck className="w-4 h-4 mr-1" />
                                  Aktifkan
                                </>
                              )}
                            </button>
                          )}
                          {user.username === 'admin' && (
                            <span className="text-gray-400 text-sm">Admin Utama</span>
                          )}
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>

              {filteredUsers.length === 0 && (
                <div className="text-center py-12">
                  <Users className="mx-auto h-12 w-12 text-gray-400" />
                  <h3 className="mt-2 text-sm font-medium text-gray-900">Tidak ada pengguna</h3>
                  <p className="mt-1 text-sm text-gray-500">Tidak ditemukan pengguna yang sesuai dengan pencarian.</p>
                </div>
              )}
            </div>
          ) : (
            <div>
              {/* Menu Table Header */}
              <div className="px-6 py-4 border-b border-gray-200">
                <h2 className="text-lg font-medium text-gray-900">Daftar Menu</h2>
                <p className="text-sm text-gray-600">Kelola menu navigasi sistem</p>
              </div>

              {/* Menu Table */}
              <div className="overflow-x-auto">
                <table className="min-w-full divide-y divide-gray-200">
                  <thead className="bg-gray-50">
                    <tr>
                      <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                      <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Menu</th>
                      <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Path</th>
                      <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Icon</th>
                      <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                  </thead>
                  <tbody className="bg-white divide-y divide-gray-200">
                    {filteredMenuItems.map((item) => (
                      <tr key={item.id} className="hover:bg-gray-50">
                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{item.id}</td>
                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{item.name}</td>
                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{item.path}</td>
                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{item.icon}</td>
                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                          <button
                            onClick={() => {
                              setSelectedItem(item);
                              setShowDeleteModal(true);
                            }}
                            className="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-5 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 transition-colors"
                          >
                            <Trash2 className="w-4 h-4 mr-1" />
                            Hapus
                          </button>
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>

              {filteredMenuItems.length === 0 && (
                <div className="text-center py-12">
                  <Menu className="mx-auto h-12 w-12 text-gray-400" />
                  <h3 className="mt-2 text-sm font-medium text-gray-900">Tidak ada menu</h3>
                  <p className="mt-1 text-sm text-gray-500">Tidak ditemukan menu yang sesuai dengan pencarian.</p>
                </div>
              )}
            </div>
          )}
        </div>
      </div>

      {/* Modal untuk konfirmasi deaktivasi user */}
      <ConfirmModal
        show={showDeactivateModal}
        onClose={() => {
          setShowDeactivateModal(false);
          setSelectedItem(null);
        }}
        onConfirm={() => selectedItem && toggleUserStatus(selectedItem.id)}
        title={selectedItem?.is_active === 1 ? "Nonaktifkan Pengguna" : "Aktifkan Pengguna"}
        message={
          selectedItem?.is_active === 1 
            ? `Apakah Anda yakin ingin menonaktifkan pengguna "${selectedItem?.username}"? Pengguna tidak akan dapat mengakses sistem.`
            : `Apakah Anda yakin ingin mengaktifkan pengguna "${selectedItem?.username}"? Pengguna akan dapat mengakses sistem kembali.`
        }
        type={selectedItem?.is_active === 1 ? "danger" : "success"}
      />

      {/* Modal untuk konfirmasi hapus menu */}
      <ConfirmModal
        show={showDeleteModal}
        onClose={() => {
          setShowDeleteModal(false);
          setSelectedItem(null);
        }}
        onConfirm={() => selectedItem && deleteMenuItem(selectedItem.id)}
        title="Hapus Menu"
        message={`Apakah Anda yakin ingin menghapus menu "${selectedItem?.name}"? Tindakan ini tidak dapat dibatalkan.`}
        type="danger"
      />
    </div>
  );
};

export default AdminDashboard;