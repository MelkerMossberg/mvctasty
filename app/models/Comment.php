<?php
class Comment {
    private $db;

    public function __construct(){
        $this->db = new Database();
    }

    public function getComments($id){
        $this->db->query('SELECT *,
                              comments.id as id,
                              comments.post_id as postId,
                              users.id as userId,
                              users.name as userName,
                              comments.body as body,
                              comments.created_at as created_at
                              FROM comments
                              INNER JOIN users ON comments.user_id = users.id
                              WHERE comments.post_id = '.$id.'
                              ORDER BY comments.created_at ASC');

        $results = $this->db->resultSet();
        return $results;
    }

    public function addComment($data){
        $this->db->query('INSERT INTO comments (user_id, body, post_id) VALUES(:user_id, :body, :post_id)');
        // Bind values
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':post_id', $data['post_id']);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }

    public function delete($id){
        $this->db->query('DELETE FROM comments WHERE id = :id');
        // Bind values
        $this->db->bind(':id', $id);

        // Execute
        if($this->db->execute()){
            return true;
        } else {
            return false;
        }
    }


}