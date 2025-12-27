<?php
trait Timestampable{
    protected ?DateTime $createdAt = null ;
    protected ?DateTime $updatedAt = null;

    protected function setCreatedAt(){
        $this->createdAt = new DateTime();
    }

    protected function setUpdatedAt(){
        $this->updatedAt=new DateTime();
    }
    

    public function getCreatedAt(){
        return $this->createdAt?->format('Y-m-d H:i:s');

    }

    public function getUpdatedAt(){
        return $this->updatedAt?->format('Y-m-d H:i:s');

    }
}

trait SoftDeletable{
    protected ?DateTime $deletedAt = null;

    public function softDelete(){
        $this->deletedAt = new DateTime();
    }
    public function restore(){
        $this->deletedAt = null;

    }

    public function isDeleted(): bool {
        return $this->deletedAt !== null;
    }
}

class Post{
    use Timestampable, SoftDeletable;
    private static int $nextId = 1;
    private int $postId;
    private string $title;
    private string $content;
    private string $author;

    public function __construct(string $title, string $content, string $author){
        $this->postId = self::$nextId++;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;

        $this->setCreatedAt();

    }

    public function updateContent(string $content) {
        $this->content = $content;
        $this->setUpdatedAt();
    }

    public function getPostId(){
      return $this->postId;  
    }
    
    public function updateTitle(string $title) {
        $this->title = $title;
        $this->setUpdatedAt();
    }



}

class Comment{
    use Timestampable, SoftDeletable;

    private int $postId;
    private string $comment;
    private string $author;

    public function __construct(int $postId, string $comment, string $author){
        $this->postId = $postId;
        $this->comment = $comment;
        $this->author = $author;

        $this->setCreatedAt();

    }

    public function getPostId(){
      return $this->postId;  
    }



    public function updateComment(string $comment){
        $this->comment = $comment;

        $this->setUpdatedAt();
    }


}
?>