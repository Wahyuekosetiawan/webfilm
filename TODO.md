# TODO: Implement Login with User/Admin Roles and Pagination on Kategori

- [x] Create migration to add 'role' column to users table
- [x] Update User model to include 'role' in fillable and add isAdmin() method
- [x] Add authentication scaffolding (login/logout routes and views)
- [x] Create middleware for admin role
- [x] Update routes/web.php to protect home and kategori routes, add admin middleware to CRUD routes
- [x] Update KategoriController index method to use pagination
- [x] Update resources/views/kategori/index.blade.php to show pagination and hide CRUD buttons for non-admin users
- [x] Update resources/views/layout.blade.php to show login/logout links and user info
- [x] Test login functionality, role restrictions, and pagination
