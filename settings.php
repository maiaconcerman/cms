<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings Page</title>
    <link rel="stylesheet" href="assets/css/settings.css">
    <script>
        // JavaScript function to show the selected section
        function showSection(sectionId) {
            const sections = document.querySelectorAll('.content section');
            sections.forEach(section => {
                section.classList.remove('active');
            });
            document.getElementById(sectionId).classList.add('active');
        }

        window.onload = function() {
            showSection('manage-users');
        };
        function toggleDropdown(menuId) {
    const menu = document.getElementById(menuId);
    if (menu.style.display === 'block') {
        menu.style.display = 'none';
    } else {
        menu.style.display = 'block';
    }
}

    </script>
</head>
<body>
    <div class="container">
    <aside class="sidebar">
    <h2>Settings</h2>
   
    <nav>
        <ul>
           
            <li><a href="#" onclick="showSection('manage-category')">Manage Category</a></li>
            <li><a href="#" onclick="showSection('manage-posts')">Manage Posts</a></li>
            <li><a href="#" onclick="showSection('upload-picture')">Upload Picture</a></li>
            <li><a href="#" onclick="showSection('backup-restore')">Backup & Restore</a></li>
            <li><a href="#" onclick="showSection('data-privacy')">Manage Data Privacy</a></li>
            <li><a href="#" onclick="showSection('edit-terms')">Edit Terms & Conditions</a></li>
            <li><a href="#" onclick="showSection('edit-faq')">Edit FAQ</a></li>
            <li><a href="#" onclick="showSection('upload-logo')">Upload Logo</a></li>
            <li><a href="#" onclick="showSection('change-banner')">Change Banner</a></li>
        </ul>
    </nav>

   
   
</aside>

        <main class="content">
         

            <section id="manage-category">
                <h3>Manage Category</h3>
                <form action="manage_category.php" method="post">
                    <label for="category">Category Name:</label>
                    <input type="text" id="category" name="category" required>
                    <button type="submit">Add Category</button>
                </form>
            </section>

            <section id="manage-posts">
                <h3>Manage Posts</h3>
                <form action="manage_posts.php" method="post">
                    <textarea name="post_content" rows="5" cols="50" placeholder="Edit your post content here"></textarea>
                    <button type="submit">Save Post</button>
                </form>
            </section>

            <section id="upload-picture">
                <h3>Upload Picture</h3>
                <form action="upload_picture.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="picture" accept="image/*" required>
                    <button type="submit">Upload</button>
                </form>
            </section>

            <section id="backup-restore">
                <h3>Backup & Restore</h3>
                <form action="backup.php" method="post">
                    <button type="submit">Backup</button>
                </form>
                <form action="restore.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="backup_file" accept=".sql" required>
                    <button type="submit">Restore</button>
                </form>
            </section>

            <section id="data-privacy">
                <h3>Manage Data Privacy</h3>
                <form action="manage_privacy.php" method="post">
                    <textarea name="privacy_policy" rows="5" cols="50" placeholder="Edit data privacy policy"></textarea>
                    <button type="submit">Save Policy</button>
                </form>
            </section>

            <section id="edit-terms">
                <h3>Edit Terms & Conditions</h3>
                <form action="edit_terms.php" method="post">
                    <textarea name="terms_conditions" rows="5" cols="50" placeholder="Edit terms and conditions"></textarea>
                    <button type="submit">Save Terms</button>
                </form>
            </section>

            <section id="edit-faq">
                <h3>Edit FAQ</h3>
                <form action="edit_faq.php" method="post">
                    <textarea name="faq_content" rows="5" cols="50" placeholder="Edit FAQ content"></textarea>
                    <button type="submit">Save FAQ</button>
                </form>
            </section>

            <section id="upload-logo">
                <h3>Upload Logo</h3>
                <form action="upload_logo.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="logo" accept="image/*" required>
                    <button type="submit">Upload Logo</button>
                </form>

            </section>

            <section id="change-banner">
                <h3>Change Banner</h3>
                <form action="change_banner.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="banner" accept="image/*" required>
                    <button type="submit">Change Banner</button>
                </form>
            </section>
        </main>
    </div>
</body>
</html>
