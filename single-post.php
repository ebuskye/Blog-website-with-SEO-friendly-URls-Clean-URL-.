<?php
require_once 'config/db.php';
require_once 'functions.php';
require_once 'includes/header.php';

$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$post = getPost($slug, $conn);

if (!$post) {
    header('HTTP/1.0 404 Not Found');
    echo '<div class="text-center py-12"><h1 class="text-4xl font-bold text-gray-900">Post not found</h1></div>';
    require_once 'includes/footer.php';
    exit();
}
?>

<article class="max-w-4xl mx-auto">
    <?php if ($post['image_url']): ?>
        <img src="<?php echo htmlspecialchars($post['image_url']); ?>" 
             alt="<?php echo htmlspecialchars($post['title']); ?>"
             class="w-full h-64 md:h-96 object-cover rounded-lg shadow-lg mb-8">
    <?php endif; ?>
    
    <h1 class="text-4xl font-bold text-gray-900 mb-4">
        <?php echo htmlspecialchars($post['title']); ?>
    </h1>
    
    <div class="flex items-center text-gray-500 mb-8">
        <time datetime="<?php echo $post['created_at']; ?>">
            <?php echo formatDate($post['created_at']); ?>
        </time>
    </div>
    
    <div class="prose prose-lg max-w-none">
        <?php echo $post['content']; ?>
    </div>
</article>

<?php require_once 'includes/footer.php'; ?>