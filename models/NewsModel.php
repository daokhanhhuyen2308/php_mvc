<?php
class NewsModel extends DB
{
    public function saveNews($title, $content, $thumbnail, $category, $publish_date)
    {
        $sql = "INSERT INTO news (title, content, thumbnail, category, publish_date, created_at) 
                VALUES (:title, :content, :thumbnail, :category, :publish_date, NOW())";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':content', $content);
        $stmt->bindParam(':thumbnail', $thumbnail);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':publish_date', $publish_date);
        return $stmt->execute();
    }
}
