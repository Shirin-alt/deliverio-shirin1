<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class StudentsController extends Controller {
    private $db;

    public function __construct()
    {
        parent::__construct();
    $this->db = Database::instance('main');
    }

    // Show students and handle new inserts (with pagination)
    public function show_form()
    {
        $perPage = 3;
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $perPage;

        // Handle new student insert
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_POST['search'])) {
            $last_name  = $_POST['last_name'] ?? '';
            $first_name = $_POST['first_name'] ?? '';
            $email      = $_POST['email'] ?? '';

            $sql = "INSERT INTO students (last_name, first_name, email) VALUES (?, ?, ?)";
            $stmt = $this->db->getPDO()->prepare($sql);
            $stmt->execute([$last_name, $first_name, $email]);
        }

        // Handle search
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        if ($search !== '') {
            $students = $this->StudentsModel->search_students($search, $perPage, $offset);
            $totalStudents = $this->StudentsModel->count_search($search);
        } else {
            $students = $this->StudentsModel->get_paginated($perPage, $offset);
            $totalStudents = $this->StudentsModel->count_all();
        }
        $totalPages = ceil($totalStudents / $perPage);

        require __DIR__ . '/../views/students_view.php';
    }

    // Update existing student
    public function update_student()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id         = isset($_POST['id']) ? (int) $_POST['id'] : 0;
            $last_name  = $_POST['last_name'] ?? '';
            $first_name = $_POST['first_name'] ?? '';
            $email      = $_POST['email'] ?? '';

            $sql = "UPDATE students SET last_name = ?, first_name = ?, email = ? WHERE id = ?";
            $stmt = $this->db->getPDO()->prepare($sql);
            $success = $stmt->execute([$last_name, $first_name, $email, $id]);

            if ($success) {
                header("Location: /students");
                exit;
            } else {
                $errorInfo = $stmt->errorInfo();
                echo "Failed to update student: " . $errorInfo[2];
            }
        } else {
            echo "Invalid Request";
        }
    }

    // Delete student
    public function delete_student()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;

            if ($id <= 0) {
                echo "❌ Invalid student ID.";
                exit;
            }

            $sql = "DELETE FROM students WHERE id = ?";
            $stmt = $this->db->getPDO()->prepare($sql);
            $success = $stmt->execute([$id]);

            if ($success) {
                header("Location: /students");
                exit;
            } else {
                $errorInfo = $stmt->errorInfo();
                echo "❌ Failed to delete student: " . $errorInfo[2];
            }
        } else {
            echo "Invalid Request (delete only accepts POST).";
        }
    }

    // No need to manually close the shared DB connection
    public function __destruct() {}
}

