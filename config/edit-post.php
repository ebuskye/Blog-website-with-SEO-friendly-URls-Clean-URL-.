<?php
require_once '../config/db.php';
require_once '../functions.php';
require_once '../includes/header.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$sql = "SELECT * FROM posts WHERE id = $id";
$result = mysqli_query($conn, $sql);
$post = mysqli_fetch_assoc($result);

if (!$post) {
    header('Location: dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $image_url = $_POST['image_url'];
    $slug = createSlug($title);
    
    $sql = "UPDATE posts 
            SET title = '".mysqli_real_escape_string($conn, $title)."',
                slug = '".mysqli_real_escape_string($conn, $slug)."',
                content = '".mysqli_real_escape_string($conn, $content)."',
                image_url = '".mysqli_real_escape_string($conn, $image_url)."'
            WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) {
        header('Location: dashboard.php');
        exit();
    }
}
?>

<div class="max-w-4xl mx-auto bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h1 class="text-2xl font-semibold text-gray-900">Edit Post</h1>
    </div>
    
    <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
        <form method="POST" class="space-y-6">
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">
                    Title
                </label>
                <input type="text" name="title" id="title" required
                       value="<?php echo htmlspecialchars($post['title']); ?>"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            
            <div>
                <label for="image_url" class="block text-sm font-medium text-gray-700">
                    Image URL (optional)
                </label>
                <input type="url" name="image_url" id="image_url"
                       value="<?php echo htmlspecialchars($post['image_url']); ?>"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            </div>
            
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">
                    Content
                </label>
                <textarea name="content" id="content" rows="10" required
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                ><?php echo htmlspecialchars($post['content']); ?></textarea>
            </div>
            
            <div class="flex justify-end space-x-4">
                <a href="dashboard.php" 
                   class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Cancel
                </a>
                <button type="submit"
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                    Update Post
                </button>
            </div>
        </form>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>