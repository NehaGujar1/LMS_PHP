<?php

namespace Model;

class Post {
    
    public static function check_reg($name,$password,$role) {
        //To check whether he/she is registered or not
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * from client_admin WHERE role = ? AND name = ?");
        $stmt->execute([$role,$name]);
        $result = $stmt->fetch();
        $vart = $result[2];
        $salt = $vart;
        $password = $salt+$password;
        $hash = hash('sha256',$password);
        $stmt = $db->prepare("SELECT * from client_admin WHERE role = ? AND name = ? AND hash = ?");
        $stmt->execute([$role,$name,$hash]);
        $final = $stmt->fetch();
        return $final;
    }
    public static function check($name,$role) {
        //Pre-registration check to ensure unique username
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * from client_admin WHERE role = ? AND name = ?");
        $stmt->execute([$role,$name]);
        $result = $stmt->fetch();
        return $result;
    }
    
    public static function insert($name,$password,$role) {
        srand(mktime());
        $salt = (string)rand(1111111111,9999999999);
        $password = $salt+$password;
        $hash = hash('sha256',$password);
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO client_admin (name, hash, salt, role) VALUES(?,?,?,?)");
        $stmt->execute([$name,$hash,$salt,$role]);
        $stmt = $db->prepare("INSERT INTO total_amt (name,fees) VALUES(?,?)");
        $stmt->execute([$name,0]);
    }
public static function insert_admin_reg($name,$password,$role) {
    srand(mktime());
    $salt = (string)rand(1111111111,9999999999);
    $password = $salt+$password;
    $hash = hash('sha256',$password);
    $db = \DB::get_instance();
    $stmt = $db->prepare("INSERT INTO admin_registration (name, hash, salt) VALUES(?,?,?)");
        $stmt->execute([$name,$hash,$salt]);
    }
    public static function get_all(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    public static function get_all_req(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT requests.*,books.book_name from requests inner join books on books.isbn = requests.isbn");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    public static function get_all_reg(){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM admin_registration");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
    public static function get_all_sp($name){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books where qty_left>0 AND isbn NOT IN (SELECT isbn from books_user where name = ? union all select isbn from requests where name = ? )");
        $stmt->execute([$name,$name]);
        $rows = $stmt->fetchAll();
        return $rows;
    }
    public static function book($book_name){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE book_name = ?");
        $stmt->execute([$book_name]);
        $row = $stmt->fetch();
        return $row;
    }
    public static function add_book($name,$auth,$qty){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE book_name = ?");
        $stmt->execute([$name]);
        $result = $stmt->fetch();
        if($result==null){
            $isbn = time()*1000;
            $stmt2 = $db->prepare("INSERT INTO books (isbn, book_name, author, qty, qty_left ) VALUES(?,?,?,?,?)");
            $stmt2->execute([$isbn,$name,$auth,$qty,$qty]);
            //echo "Added-2";
        }
        else {
            $temp = $result[3] + $qty ;
            $temp2 = $result[4] + $qty ;
            $stmt2 = $db->prepare("UPDATE books SET qty = ?, qty_left = ? WHERE book_name = ?");
            $stmt2->execute([$temp,$temp2,$name]);
        }

    }
    public static function delete_book($name){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM books WHERE book_name = ?");
        $stmt->execute([$name]);
        $result = $stmt->fetch();
        $TEMP = $result[0];
        $stmt = $db->prepare("DELETE FROM books WHERE isbn = ?");
        $stmt->execute([$TEMP]);
        //$result = $stmt->fetch();
        $stmt = $db->prepare("DELETE FROM books_user WHERE isbn = ?");
        $stmt->execute([$TEMP]);
        //$result = $stmt->fetch();
        $stmt = $db->prepare("DELETE FROM requests WHERE isbn = ?");
        $stmt->execute([$TEMP]);
        //$result = $stmt->fetch();
        //echo "DELETED";
    }
    public static function check_req($array,$name){
        $db = \DB::get_instance();
        $stmt = $db->prepare("DELETE FROM requests WHERE isbn = ?");
        $stmt->execute([$array]);
        $var = time();
        $stmt2 = $db->prepare("INSERT INTO books_user (isbn, name ) VALUES(?,?)");
        $stmt2->execute([$array,$name]);
        $stmt2 = $db->prepare("INSERT INTO fees (isbn, name, in_time ) VALUES(?,?,?)");
        $stmt2->execute([$array,$name,$var]);
    }
    public static function check_req_d($array,$name){
        $db = \DB::get_instance();
        $stmt = $db->prepare("DELETE FROM requests WHERE isbn = ?");
        $stmt->execute([$array]);
        $stmt3 = $db->prepare("SELECT * FROM books WHERE isbn = ?");
        $stmt3->execute([$array]);
        $res = $stmt3->fetch();
        //echo $res;
        // echo $res[4];
        // echo "hi";
        $temp2 = $res[4] + 1;
        $stmt2 = $db->prepare("UPDATE books SET qty_left = ? WHERE isbn = ?");
        $stmt2->execute([$temp2,$array]);
    }
    public static function reg_approval($name){
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT * FROM admin_registration WHERE name = ?");
        $stmt->execute([$name]);
        $result = $stmt->fetch();
        $hash = $result[1];
        $salt = $result[2];
        $role = 'admin';
        $stmt = $db->prepare("DELETE FROM admin_registration WHERE name = ?");
        $stmt->execute([$name]);
        $stmt = $db->prepare("INSERT INTO client_admin (name, hash, salt, role) VALUES(?,?,?,?)");
        $stmt->execute([$name,$hash,$salt,$role]);
    }
    public static function reg_disapproval($name){
        $db = \DB::get_instance();
        $stmt = $db->prepare("DELETE FROM admin_registration WHERE name = ?");
        $stmt->execute([$name]);
    }
    public static function check_r_c($name,$isbn) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("INSERT INTO requests (name, isbn) VALUES(?,?)");
        $stmt->execute([$name,$isbn]);
        $stmt3 = $db->prepare("SELECT * FROM books WHERE isbn = ?");
        $stmt3->execute([$isbn]);
        $res = $stmt3->fetch();
        $temp2 = $res[4] - 1;
        $stmt2 = $db->prepare("UPDATE books SET qty_left = ? WHERE isbn = ?");
        $stmt2->execute([$temp2,$isbn]);
    }
    public static function ur_bk($name) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("SELECT books.* from books inner join books_user on books_user.isbn = books.isbn where books_user.name = ?");
        $stmt->execute([$name]);
        $rows = $stmt->fetchAll();
        $var = time();
        return $rows;
    }
    public static function ur_bk_dlt($name,$isbn) {
        $db = \DB::get_instance();
        $stmt = $db->prepare("DELETE FROM books_user WHERE  isbn = ? AND name = ?");
        $stmt->execute([$isbn,$name]);
        $stmt3 = $db->prepare("SELECT * FROM books WHERE isbn = ?");
        $stmt3->execute([$isbn]);
        $res = $stmt3->fetch();
        $temp2 = $res[4] + 1;
        $stmt2 = $db->prepare("UPDATE books SET qty_left = ? WHERE isbn = ?");
        $stmt2->execute([$temp2,$isbn]);
        $var = time();
        $fees = 0;
        $stmt2 = $db->prepare("SELECT * FROM fees WHERE isbn = ? AND name = ?");
        $stmt2->execute([$isbn,$name]);
        $res = $stmt2->fetch();
        $diff = $var - $res[2];
        if($diff>604800){
            $fees = (int)(($diff -604800)/86400) ;
            //Every day charge is 1 Rs
        }
        $stmt2 = $db->prepare("UPDATE fees SET out_time = ?, fees = ? WHERE isbn = ? AND name = ?");
        $stmt2->execute([$var,$fees,$isbn,$name]);
        $stmt2 = $db->prepare("SELECT * FROM total_amt WHERE name = ?");
        $stmt2->execute([$name]);
        $res = $stmt2->fetch();
        $temp = $res[1] + $fees ;
        $stmt2 = $db->prepare("UPDATE total_amt SET fees = ? WHERE name = ?");
        $stmt2->execute([$temp,$name]);
    }
    public static function fees_found($name){
        $db = \DB::get_instance();
        $stmt3 = $db->prepare("SELECT fees FROM total_amt WHERE name = ?");
        $stmt3->execute([$name]);
        $res = $stmt3->fetch();
        return $res;
    }
}
