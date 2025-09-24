<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: StudentsModel
 * 
 * Automatically generated via CLI.
 */
class StudentsModel extends Model 
{
    protected $table = 'students';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    // Fetch students with limit and offset for pagination
    public function get_paginated($limit, $offset)
    {
        $sql = "SELECT * FROM {$this->table} LIMIT :limit OFFSET :offset";
        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Search students by last name, first name, or email
    public function search_students($search, $limit, $offset)
    {
    $limit = (int)$limit;
    $offset = (int)$offset;
    $sql = "SELECT * FROM {$this->table} WHERE last_name LIKE :search1 OR first_name LIKE :search2 OR email LIKE :search3 LIMIT $limit OFFSET $offset";
    $stmt = $this->db->getPDO()->prepare($sql);
    $searchTerm = "%" . $search . "%";
    $stmt->bindValue(':search1', $searchTerm, PDO::PARAM_STR);
    $stmt->bindValue(':search2', $searchTerm, PDO::PARAM_STR);
    $stmt->bindValue(':search3', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Count students matching search
    public function count_search($search)
    {
    $sql = "SELECT COUNT(*) as total FROM {$this->table} WHERE last_name LIKE :search1 OR first_name LIKE :search2 OR email LIKE :search3";
    $stmt = $this->db->getPDO()->prepare($sql);
    $searchTerm = "%" . $search . "%";
    $stmt->bindValue(':search1', $searchTerm, PDO::PARAM_STR);
    $stmt->bindValue(':search2', $searchTerm, PDO::PARAM_STR);
    $stmt->bindValue(':search3', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
    }

    // Get total number of students
    public function count_all()
    {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $stmt = $this->db->getPDO()->query($sql);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
}