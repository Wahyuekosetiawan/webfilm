# TODO: Enable Image/Video Upload in Kategori CRUD

1. [x] Create migration for adding media column to kategoris table.
2. [x] Edit the migration file to add the media column (string, nullable).
3. [x] Update Kategori model to include 'media' in $fillable.
4. [x] Update KategoriController store method to validate and handle file upload.
5. [x] Update KategoriController update method to validate and handle file upload.
6. [x] Update create.blade.php to include enctype and file input for media.
7. [x] Update edit.blade.php to include enctype, file input, and display current media if exists.
8. [x] Update index.blade.php to add a Media column and display image/video if present.
9. [x] Run the migration to apply database changes.
10. Test the CRUD functionality with file uploads.
