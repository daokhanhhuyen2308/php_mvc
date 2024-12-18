<?php
session_start();
class Review extends Controller
{
    public function addReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_SESSION['user']['username'] ?? null;
            $masp = $_POST['masp'];
            $rating = $_POST['rating'];
            $comment = $_POST['comment'];

            if ($username && $masp && $rating && $comment) {
                $reviewModel = $this->model("ReviewModel");
                $success = $reviewModel->addReview($username, $masp, $rating, $comment);

                if ($success) {
                    echo json_encode(['status' => 'success', 'message' => 'Đánh giá thành công!']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra, vui lòng thử lại.']);
                }
            }
        }
    }

    public function updateReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_SESSION['user']['username'] ?? null;
            $masp = $_POST['masp'];
            $rating = $_POST['rating'];
            $comment = $_POST['comment'];

            if ($username && $masp && $rating && $comment) {
                $reviewModel = $this->model("ReviewModel");
                $success = $reviewModel->updateReview($masp, $username, $comment, $rating);

                if ($success) {
                    echo json_encode(['status' => 'success', 'message' => 'Cập nhật đánh giá thành công!']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra, vui lòng thử lại.']);
                }
            }
        }
    }

    public function deleteReview()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $reviewID = $_POST['review_id'];

            $reviewModel = $this->model("ReviewModel");
            $success = $reviewModel->deleteReview($reviewID);

            if ($success) {
                echo json_encode(['status' => 'success', 'message' => 'Xóa đánh giá thành công!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Có lỗi xảy ra, vui lòng thử lại.']);
            }
        }
    }
}
