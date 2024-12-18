<?php
class ReviewModel extends DB
{

    public function getShowReviews()
    {
        $sql = "SELECT * FROM reviews";
        $stm = $this->conn->prepare($sql);
        $stm->execute();
        $reviews = $stm->fetchAll();
        return $reviews;
    }

    public function getReviewByProductID($masp)
    {
        $sql = "SELECT r.review_id, r.username, r.rating, r.comment, r.created_at, u.fullname
            FROM reviews r
            INNER JOIN users u ON r.username = u.username
            WHERE r.masp = :masp
            ORDER BY r.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':masp', $masp);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function addReview($username, $masp, $rating, $comment)
    {
        $sql = "INSERT INTO reviews (username, masp, rating, comment) 
            VALUES (:username, :masp, :rating, :comment)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':masp', $masp);
        $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
        $stmt->bindParam(':comment', $comment);
        return $stmt->execute();
    }

    public function getReviewByID($reviewID)
    {
        $sql = "SELECT * FROM reviews WHERE review_id = :reviewID";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':reviewID', $reviewID);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteReview($reviewID, $username)
    {
        $sql = "DELETE FROM reviews 
                WHERE review_id = :reviewID AND username = :username";
        $stm = $this->conn->prepare($sql);
        $stm->bindParam(':reviewID', $reviewID);
        $stm->bindParam(':username', $username);
        $stm->execute();
        return $stm->rowCount();
    }

    public function updateReview($masp, $username, $comment, $rating)
    {
        $sql = "UPDATE reviews SET comment = :comment, rating = :rating WHERE masp = :masp AND username = :username";
        $stm = $this->conn->prepare($sql);
        $stm->bindParam(':masp', $masp);
        $stm->bindParam(':username', $username);
        $stm->bindParam(':comment', $comment);
        $stm->bindParam(':rating', $rating);
        $stm->execute();
        return $stm->rowCount();
    }
}
