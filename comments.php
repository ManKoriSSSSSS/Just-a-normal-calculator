<?php
// Mock persistence for this example
session_start();
if (!isset($_SESSION['comments'])) {
    $_SESSION['comments'] = [
        ['name' => 'Admin', 'text' => 'Welcome to the feedback section!']
    ];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['comment'])) {
    $newComment = [
        'name' => htmlspecialchars($_POST['user'] ?? 'Anonymous'),
        'text' => htmlspecialchars($_POST['comment'])
    ];
    array_push($_SESSION['comments'], $newComment);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-4">User Comments</h1>
        
        <form method="POST" class="mb-8">
            <input type="text" name="user" placeholder="Your name" class="w-full p-2 mb-2 border rounded">
            <textarea name="comment" placeholder="Leave a comment..." class="w-full p-2 border rounded h-24 mb-2" required></textarea>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Post Comment</button>
        </form>

        <div class="space-y-4">
            <?php foreach (array_reverse($_SESSION['comments']) as $c): ?>
                <div class="border-b pb-2">
                    <p class="font-bold text-sm text-gray-600"><?php echo $c['name']; ?></p>
                    <p class="text-gray-800"><?php echo $c['text']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="mt-8 text-center">
            <a href="index.php" class="text-blue-400 underline">Back to start</a>
        </div>
    </div>

</body>
</html>
