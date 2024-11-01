<?php
require_once '../config/db.php';
require_once '../functions.php';
require_once '../includes/header.php';

$posts = getAllPosts($conn);
?>

<div class="bg-white shadow rounded-lg">
    <div class="px-4 py-5 sm:px-6 flex justify-between items-center">
        <h1 class="text-2xl font-semibold text-gray-900">Posts Dashboard</h1>
        <a href="create-post.php" 
           class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
            Create New Post
        </a>
    </div>
    
    <div class="border-t border-gray-200">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Title
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Created
                    </th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">
                                <?php echo htmlspecialchars($post['title']); ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <?php echo formatDate($post['created_at']); ?>
                        </td>
                        <td class="px-6 py-4 text-right text-sm font-medium">
                            <a href="edit-post.php?id=<?php echo $post['id']; ?>" 
                               class="text-blue-600 hover:text-blue-900 mr-4">
                                Edit
                            </a>
                            <a href="delete-post.php?id=<?php echo $post['id']; ?>" 
                               class="text-red-600 hover:text-red-900"
                               onclick="return confirm('Are you sure you want to delete this post?')">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>