<?php
$dataFile = 'comments.json';

// Initialize the file if it doesn't exist
if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode([]));
}

// Handle new comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['comment'])) {
    $comments = json_decode(file_get_contents($dataFile), true);
    
    $newComment = [
        'name' => htmlspecialchars($_POST['user'] ?: 'Anonymous'),
        'text' => htmlspecialchars($_POST['comment']),
        'date' => date('Y-m-d H:i')
    ];
    
    $comments[] = $newComment;
    file_put_contents($dataFile, json_encode($comments));
    
    // Refresh to prevent form resubmission
    header("Location: comments.php");
    exit();
}

// Load existing comments
$comments = json_decode(file_get_contents($dataFile), true) ?: [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Feedback</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Comic Neue', cursive; }
    </style>
</head>
<body class="bg-yellow-50 min-h-screen p-4 md:p-8">

    <div class="max-w-2xl mx-auto bg-white border-4 border-black rounded-3xl shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] p-6">
        <h1 class="text-4xl font-bold mb-6 text-center italic">Comments Wall</h1>
        
        <form method="POST" class="mb-10 bg-gray-50 p-4 border-2 border-dashed border-gray-400 rounded-xl">
            <div class="mb-4">
                <label class="block font-bold mb-1">Your Name:</label>
                <input type="text" name="user" class="w-full p-2 border-2 border-black rounded-lg" placeholder="Guest">
            </div>
            <div class="mb-4">
                <label class="block font-bold mb-1">Comment:</label>
                <textarea name="comment" class="w-full p-2 border-2 border-black rounded-lg h-24" placeholder="What do you think?" required></textarea>
            </div>
            <button type="submit" class="bg-yellow-400 border-2 border-black font-bold px-6 py-2 rounded-lg hover:bg-yellow-300 transition shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-x-1 active:translate-y-1">
                Post Feedback
            </button>
        </form>

        <div class="space-y-6">
            <?php if (empty($comments)): ?>
                <p class="text-center text-gray-500 italic">No comments yet. Be the first!</p>
            <?php else: ?>
                <?php foreach (array_reverse($comments) as $c): ?>
                    <div class="border-l-4 border-yellow-400 pl-4 py-2">
                        <div class="flex justify-between items-center mb-1">
                            <span class="font-bold text-lg text-black"><?php echo $c['name']; ?></span>
                            <span class="text-xs text-gray-400"><?php echo $c['date']; ?></span>
                        </div>
                        <p class="text-gray-700 leading-relaxed"><?php echo $c['text']; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        
        <div class="mt-12 text-center border-t-2 border-black pt-4">
            <a href="index.php" class="font-bold text-blue-600 hover:underline">← Return to Main Menu</a>
        </div>
    </div>

</body>
</html>
