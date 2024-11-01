<?php
require_once 'config/db.php';
require_once 'functions.php';
require_once 'includes/header.php';

$posts = getAllPosts($conn);
?>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <?php foreach ($posts as $post): ?>
        <article class="bg-white rounded-lg shadow-md overflow-hidden">
            <?php if ($post['image_url']): ?>
                <img src="<?php echo htmlspecialchars($post['image_url']); ?>" 
                     alt="<?php echo htmlspecialchars($post['title']); ?>"
                     class="w-full h-48 object-cover">
            <?php endif; ?>
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-2">
                    <a href="/blog/<?php echo htmlspecialchars($post['slug']); ?>" 
                       class="text-gray-900 hover:text-blue-600">
                        <?php echo htmlspecialchars($post['title']); ?>
                    </a>
                </h2>
                <p class="text-gray-500 text-sm mb-4">
                    <?php echo formatDate($post['created_at']); ?>
                </p>
                <p class="text-gray-600 line-clamp-3">
                    <?php echo substr(strip_tags($post['content']), 0, 150) . '...'; ?>
                </p>
                <a href="/blog/<?php echo htmlspecialchars($post['slug']); ?>" 
                   class="inline-block mt-4 text-blue-600 hover:text-blue-800">
                    Read more →
                </a>
            </div>
        </article>
    <?php endforeach; ?>
</div>

<?php require_once 'includes/footer.php'; ?>