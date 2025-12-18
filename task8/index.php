<?php
include "traits.php";

// --- 1. Creating Posts ---
$post1 = new Post("First Post", "Hello world!", "Admin");
$post2 = new Post("Second Post", "PHP is fun", "Editor");

// Display Post IDs and timestamps
echo "Post 1 ID: {$post1->getPostId()}, Created At: {$post1->getCreatedAt()}<br>";
echo "Post 2 ID: {$post2->getPostId()}, Created At: {$post2->getCreatedAt()}<br>";
echo   "<br>";

// --- 2. Updating Post content and title ---
$post1->updateContent("Hello world updated!");
$post1->updateTitle("Updated First Post");

echo "Post 1 Updated Content Timestamp: {$post1->getUpdatedAt()}<br>";
echo   "<br>";

// --- 3. Creating Comments ---
$comment1 = new Comment($post1->getPostId(), "Nice post!", "John");
$comment2 = new Comment($post2->getPostId(), "Great post!", "Jane");

echo "Comment 1 for Post ID: {$comment1->getPostId()}, Created At: {$comment1->getCreatedAt()}<br>";
echo "Comment 2 for Post ID: {$comment2->getPostId()}, Created At: {$comment2->getCreatedAt()}<br>";
echo   "<br>";

// --- 4. Updating a Comment ---
$comment1->updateComment("Really nice post!");
echo "Comment 1 Updated At: {$comment1->getUpdatedAt()}<br>";
echo   "<br>";

// --- 5. Soft Delete Post 2 ---
$post2->softDelete();
echo "Post 2 is deleted? " . ($post2->isDeleted() ? "Yes" : "No") . "<br>";
echo   "<br>";

// --- 6. Restore Post 2 ---
$post2->restore();
echo "Post 2 is deleted after restore? " . ($post2->isDeleted() ? "Yes" : "No") . "<br>";
echo   "<br>";

// --- 7. Soft Delete a Comment ---
$comment2->softDelete();
echo "Comment 2 is deleted? " . ($comment2->isDeleted() ? "Yes" : "No") . "<br>";
echo   "<br>";

// --- 8. Show final timestamps ---
echo "Post 1 Created At: {$post1->getCreatedAt()}, Updated At: {$post1->getUpdatedAt()}<br>";
echo "Comment 1 Created At: {$comment1->getCreatedAt()}, Updated At: {$comment1->getUpdatedAt()}<br>";
echo   "<br>";

?>
